<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>
    <label>
        <?php
        echo Html::checkbox("idTipoOrganismo[$organismo->primaryKey][{$models[0]->idTipoDescritor}]", 
                isset($_REQUEST["idTipoOrganismo"])?(isset($_REQUEST["idTipoOrganismo"][$organismo->primaryKey][$models[0]->idTipoDescritor])):true, ["class" => "idTipoOrganismo"]);
        ?>
        Considerar espécie
    </label>
<hr style="margin-top: 2px"/>
<?php
echo Html::checkboxList("Atributos[$organismo->primaryKey][{$models[0]->idTipoDescritor}]", 
        isset($_REQUEST["idTipoOrganismo"])?
                ($_REQUEST["Atributos"][$organismo->primaryKey][$models[0]->idTipoDescritor])
            :ArrayHelper::getColumn($models, ["idDescritor"]),
        ArrayHelper::map($models, 'idDescritor', 'label'));
