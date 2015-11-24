<?php
/**
 * Description of newPHPClass
 *
 * @author schvarcz
 */
namespace app\commands;

use yii\console\Controller;
use app\models\Exportacao;
use app\models\ExportacaoSearch;

class ExportacaoController extends Controller
{
    public function actionExport()
    {
        $exportPath = \Yii::$app->basePath."/exporting";
        mkdir($exportPath);
        $exportacoes = Exportacao::findAll(["percent"=>NULL]);
        foreach($exportacoes as $exportacao)
        {
            echo $exportacao->sql;
            parse_str($exportacao->sql, $_REQUEST);
            print_r($_REQUEST);
            
            $exportacaoSearch = new ExportacaoSearch();
            $query = $exportacaoSearch->searchQuery($_REQUEST);
            $coletas = $query->all();
            $organismo = $this->getOrganismos($coletas);
            $this->getDescritores($organismo);
            print_r($organismo);
            echo "\n";
        }
        echo $exportPath."\n";
    }
    
    public function dumpAll($coletas)
    {
        foreach($coletas as $coleta)
        {
            $coleta = new \app\models\Coleta;
            $coleta->idUnidadeGeografica;
            $coleta->Data_Coleta;
            $coleta->Observacao;
            $coleta->idMetodo0;
            $coleta->idProjeto0;
            $coleta->idPesquisadorRegistro0;

            $outColeta = [$coleta->Data_Coleta, 
                $coleta->idUnidadeGeografica0->getLabel(), 
                $coleta->idMetodo0->getLabel(),
                $coleta->idProjeto0->getLabel(),
                $coleta->idPesquisadorRegistro0->Nome
            ];
            foreach($coleta->coletaItems as $item)
            {
                $item->idEspecie0;
                $item->idNaoIdentificado0;
                $outItem = [
                    $item->idTipoOrganismo,
                    $item->idEspecie0?$item->idEspecie0->getLabel():$item->idNaoIdentificado0->MorfoEspecie
                ];

                foreach($item->coletaItemPropriedades as $propriedade)
                {
                    $outItemProp = [
                        $propriedade->value
                    ];
                }
            }
        }
    }
    
    public function getOrganismos($coletas)
    {
        $especies = [];
        foreach($coletas as $coleta)
        {
            foreach($coleta->coletaItems as $item)
            {
                $especies[$item->idTipoOrganismo->primaryKey] = [ "tipoOrganismo" => $item->idTipoOrganismo];
            }
        }
        return $especies;
    }
    
    public function getDescritores(&$organimos)
    {
        foreach(array_keys($organimos) as $key)
        {
            $descritores = array_merge(\app\models\Descritor::findAll(["idDescritor" => $_REQUEST["Atributos"][$key][1]]),\app\models\Descritor::findAll(["idDescritor" => $_REQUEST["Atributos"][$key][2]]));
            $organimos[$key]["Descritores"] = $descritores;
        }
    }
}
