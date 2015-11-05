<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var app\models\Atributo $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="curadoria-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php $this->beginBlock('main'); ?>

        <p>
            <?php
            $tipoOrganimos = \app\models\TipoOrganismo::find()->all();
            foreach($tipoOrganimos as $tipoOrganimo)
            {
                $key = md5($tipoOrganimo->primaryKey);
                echo Html::hiddenInput("curadoria[$key][idTipoOrganismo]", $tipoOrganimo->primaryKey);
                $curadores = app\models\Pesquisador::find()->joinWith("curadorias")->where(["idTipoOrganismo"=>$tipoOrganimo->primaryKey])->all();
                ?>
                <div class="form-group">
                    <label class="control-label col-sm-3">Curadores para <?= $tipoOrganimo->label ?></label>
                    <div class = "col-sm-6">
                    <?php
                    echo \app\widgets\Select2Active\Select2Active::widget([
                        "id" => "curadoria$tipoOrganimo->primaryKey",
                        "name" => "curadoria[$key][curadores]",
                        "value" => ArrayHelper::getColumn($curadores, "primaryKey"),
                        "data" => ArrayHelper::map($curadores, "primaryKey", "label"),
                        'options' => [
                            "multiple" => true
                        ],
                        'pluginOptions' => [
                            'allowClear' => true,
                            'ajax' => [
                                'url' => yii\helpers\Url::to(["pesquisador/findpesquisador"]),
                                'dataType' => 'json',
                                'data' => new JsExpression('function(term,page) { return {pesquisador:term.term}; }'),
                                'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                            ],
                            'initSelection' => true
                        ],
                    ]);
                    ?>
                    </div>
                </div>
                <?php
            }
            ?>
        </p>
        <?php $this->endBlock(); ?>

        <?=
        \yii\bootstrap\Tabs::widget(
                [
                    'encodeLabels' => false,
                    'items' => [ [
                            'label' => 'Curadoria',
                            'content' => $this->blocks['main'],
                            'active' => true,
                        ],]
                ]
        );
        ?>
        <hr/>

        <?=
        Html::submitButton('<span class="glyphicon glyphicon-check"></span> Salvar', ['class' => 'btn btn-primary'])
        ?>
        
        <?php ActiveForm::end(); ?>

    </div>

</div>
