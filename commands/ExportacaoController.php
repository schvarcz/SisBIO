<?php
/**
 * Description of Exportacao
 *
 * @author schvarcz
 */
namespace app\commands;

use yii\console\Controller;
use app\models\Exportacao;
use app\models\ExportacaoSearch;
use yii\helpers\ArrayHelper;
use app\models\Descritor;
use app\models\Coleta;
use app\models\TipoOrganismo;

class ExportacaoController extends Controller
{
    private $exportPath = __DIR__."/../exporting";
    public function actionExport()
    {
        while(true)
        {
            $exportacoes = Exportacao::find()->orWhere(["!=","percent",1])->orWhere(["percent"=>NULL])->all(); 
            foreach($exportacoes as $exportacao)
            {
                parse_str($exportacao->sql, $_REQUEST);

                $organismosQuery = $this->getOrganismos($_REQUEST);
                $this->getDescritores($organismosQuery);
                $this->createFileHeaders($organismosQuery);

                $exportacaoSearch = new ExportacaoSearch();
                $coletasQuery = $exportacaoSearch->searchQuery($_REQUEST);
                $total = (float)$coletasQuery->count();
                foreach($coletasQuery->all() as $key => $coleta)
                {
                    $this->dumpColeta($coleta, $organismosQuery);
                    $exportacao->percent = ($key+1)/$total;
                    $exportacao->save();
                }

                //Export data to a file.
                if($this->saveToFile($organismosQuery,$this->exportPath."/Exportacao-".$exportacao->primaryKey.".zip"))
                {
                    $exportacao->file = "/../exporting/Exportacao-".$exportacao->primaryKey.".zip";
                    $exportacao->save();
                    echo "Exported: $exportacao->file\n";
                }
            }
            sleep(1);
        }
        echo $this->exportPath."\n";
    }
    
    public function createFolder()
    {
        if(!file_exists($this->exportPath))
        {
            mkdir($this->exportPath);
        }
        $folder = "/".md5(time().rand());
        
        mkdir($this->exportPath.$folder);
        return $this->exportPath.$folder;
    }
    
    public function getOrganismos($query)
    {
        $organismos = [];
        foreach($query["idTipoOrganismo"] as $key => $tipoAtributos)
        {
            $organismos[$key] = [
                "tipoOrganismo" => TipoOrganismo::findOne($key),
                "Descritores" => $tipoAtributos,
                "exportData" => [1 => [], 2=>[]] //para os dois tipos de descritores
                ];
        }
        return $organismos;
    }
    
    public function getDescritores(&$organimos)
    {
        foreach(array_keys($organimos) as $key)
        {
            //Os dois tipos de descritores.
            $organimos[$key]["Descritores"][1] = Descritor::findAll(["idDescritor" => $_REQUEST["Atributos"][$key][1]]);
            $organimos[$key]["Descritores"][2] = Descritor::findAll(["idDescritor" => $_REQUEST["Atributos"][$key][2]]);
        }
    }
    
    public function createFileHeaders(&$organismoQuery)
    {
        $coletaLabels = (new Coleta)->attributeLabels();
        $organismoLabels = (new TipoOrganismo)->attributeLabels();
        $headerColeta = [
            $coletaLabels["Data_Coleta"],
            "Unidade geográfica",
            $coletaLabels["idMetodo"],
            $coletaLabels["idProjeto"],
            $coletaLabels["Observacao"],
            $coletaLabels["idPesquisadorRegistro"],
            $organismoLabels["Nome"],
            "Nome da Espécia/MorfoEspécime"
        ];
        
        foreach($organismoQuery as $key => $value)
        {
            $organismoQuery[$key]["exportData"][1]["header"] = ArrayHelper::merge($headerColeta, ArrayHelper::getColumn($value["Descritores"][1] , "Nome"));
            $organismoQuery[$key]["exportData"][2]["header"] = ArrayHelper::merge($headerColeta, ArrayHelper::getColumn($value["Descritores"][2] , "Nome"));
        }
    }
    
    public function dumpColeta($coleta, &$organismoQuery)
    {
        $outColeta = [$coleta->Data_Coleta, 
            $coleta->idUnidadeGeografica0->getLabel(), 
            $coleta->idMetodo0->getLabel(),
            $coleta->idProjeto0->getLabel(),
            $coleta->Observacao,
            $coleta->idPesquisadorRegistro0->Nome
        ];
        foreach($coleta->coletaItems as $item)
        {
            //Ver o organismo deve ser exportado.
            if (!array_key_exists($item->idTipoOrganismo->primaryKey, $organismoQuery)) 
            {
                continue;
            }

            $outItem = [
                $item->idTipoOrganismo->getLabel(),
                $item->idEspecie0?$item->idEspecie0->getLabel():$item->idNaoIdentificado0->MorfoEspecie
            ];

            $outItemProp = [];
            
            //Ver quais atributos estão sendo solicitados
            foreach($organismoQuery[$item->idTipoOrganismo->primaryKey]["Descritores"] as $key => $descritores)
            {
                $outItemProp[$key] = [];
                $itemDescritores = ArrayHelper::map(
                        $item->getColetaItemPropriedades()->joinWith("idDescritor0", true, "INNER JOIN")->where(["idTipoDescritor" => $key])->all(),
                        "idDescritor",function($ele){return $ele;});
                if ($itemDescritores != [])
                {
                    foreach($descritores as $descritor)
                    {
                        $outItemProp[$key][] = $itemDescritores[$descritor->primaryKey]->value;
                    }
                    $line = array_merge($outColeta,$outItem,$outItemProp[$key]);
                    $organismoQuery[$item->idTipoOrganismo->primaryKey]["exportData"][$key]["data"][] = $line;
                }
            }
        }
    }

    public function saveToFile($organismosQuery,$fileName) 
    {
        //Criar uma pasta para os arquivos a serem exportados.
        $currentFolder = $this->createFolder();
        $files = [];
        foreach($organismosQuery as $key => $organismo)
        {
            foreach($organismo["exportData"] as $keyTpoDescritor => $data)
            {
                if($data["data"] != [])
                {
                    //Exporta!
                    $fileOrganismo = utf8_decode($currentFolder."/".$organismo["tipoOrganismo"]->Nome.".csv");
                    $ptrFile = fopen($fileOrganismo,"w");
                    fprintf($ptrFile, utf8_decode(implode(";",$data["header"])."\n"),[]);
                    foreach($data["data"] as $row)
                    {
                        fprintf($ptrFile, utf8_decode(implode(";",$row)."\n"));
                    }
                    fclose($ptrFile);
                    $files[] = $fileOrganismo;
                }
            }
        }
        //Zippar o arquivo e atualizar na tabela
        return $this->createZip($files,$fileName);
        //rmdir($currentFolder);
    }
    /* creates a compressed zip file */
    public function createZip($files = array(),$destination = '',$overwrite = true) {
        //if the zip file already exists and overwrite is false, return false
        if(file_exists($destination) && !$overwrite)
        {
            return false;
        }
        //vars
        $valid_files = array();
        //if files were passed in...
        if(is_array($files)) {
            //cycle through each file
            foreach($files as $file) {
                //make sure the file exists
                if(file_exists($file)) {
                    $valid_files[] = $file;
                }
            }
        }
        //if we have good files...
        if(count($valid_files)) {
            //create the archive
            
            $zip = new \ZipArchive();
            if($zip->open($destination,  (file_exists($destination) && $overwrite) ? \ZIPARCHIVE::OVERWRITE : \ZIPARCHIVE::CREATE) !== true)
            {
                return false;
            }
            //add the files
            foreach($valid_files as $file) 
            {
                $parts = explode("/",$file);
                $zip->addFile($file,utf8_encode($parts[count($parts)-1]));
            }
            //debug
            //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;

            //close the zip -- done!
            $zip->close();

            //check to make sure the file exists
            return file_exists($destination);
        }
        else
        {
            return false;
        }
    }

}
