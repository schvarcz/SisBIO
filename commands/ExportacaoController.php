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
            
            $exportacaoSearch = new ExportacaoSearch();
            $query = $exportacaoSearch->searchQuery($_REQUEST);
            print_r($_REQUEST);
            echo "\n";
        }
        echo $exportPath."\n";
    }
}
