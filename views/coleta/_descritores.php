<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]);

echo Html::hiddenInput("idTipoOrganismo", $organismo->primaryKey);
echo Html::checkboxList("Atributos", ArrayHelper::getColumn($models,["idDescritor"]), ArrayHelper::map($models, 'idDescritor', 'label'));

ActiveForm::end(); ?>