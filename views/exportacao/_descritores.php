<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;


echo Html::checkboxList("Atributos[$organismo->primaryKey]", ArrayHelper::getColumn($models, ["idDescritor"]), ArrayHelper::map($models, 'idDescritor', 'label'));
