<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use kartik\select2\Select2;

/**
 * @var yii\web\View $this
 * @var app\models\Coleta $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJsFile(Yii::$app->homeUrl . "js/coletaPlugin.js", [ "depends" => ['yii\web\JqueryAsset']]);
$this->registerCssFile(Yii::$app->homeUrl . "css/coleta.css");
$script = 'jQuery(".plus-coleta").coletaPlus({});';


$this->registerJs($script);
?>

<div class="coleta-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>
        <?php $this->beginBlock('main'); ?>

        <p>

            <?=
            $form->field($model, 'Data_Coleta')->widget(\zhuravljov\widgets\DatePicker::className(), [
                'options' => ['class' => 'form-control'],
                'clientOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                ],
            ])
            ?>
            <?=
            // generated by schmunk42\giiant\crud\providers\RelationProvider::activeField
            $form->field($model, 'idUnidadeGeografica')->dropDownList(
                    \yii\helpers\ArrayHelper::map(app\models\UnidadeGeografica::find()->all(), 'idUnidadeGeografica', 'label'), ['prompt' => 'Choose...']
            );
            ?>
            <?= $form->field($model, 'Observacao')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'coordenadaGeografica')->textInput() ?>

        <div class="form-group">
            <label class="control-label col-sm-3">Espécies</label>
            <div class = "col-sm-6">
                <?=
                Select2::widget([
                    'name' => 'especie_add',
                    'data' => $data,
                    'options' => [
                        'placeholder' => 'Selecione a espécie a ser adicionada',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 1,
                        'ajax' => [
                            'url' => yii\helpers\Url::to(["coleta/findesp"]),
                            'dataType' => 'json',
                            'data' => new JsExpression('function(term,page) { return {nomeEspecie:term}; }'),
                            'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                        ]
                    ],
                    'addon' => [
                        'append' => [
                            'content' => Html::button('<span class="glyphicon glyphicon-plus"></span>', [
                                'class' => 'btn btn-primary plus-coleta',
                                'title' => 'Adiciona espécie a sua coleta',
                                'data-toggle' => 'tooltip'
                            ]),
                            'asButton' => true
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>

        <div class="form-group">
            <div class = "col-sm-12 coletaItensContainer">
            </div>
        </div>
        </p>
        <?php $this->endBlock(); ?>

        <?=
        \yii\bootstrap\Tabs::widget(
                [
                    'encodeLabels' => false,
                    'items' => [ [
                            'label' => 'Coleta',
                            'content' => $this->blocks['main'],
                            'active' => true,
                        ],]
                ]
        );
        ?>
        <hr/>

        <?=
        Html::submitButton('<span class="glyphicon glyphicon-check"></span> ' . ($model->isNewRecord ? 'Criar' : 'Salvar'), ['class' => $model->isNewRecord ?
                    'btn btn-primary' : 'btn btn-primary'])
        ?>

        <?= Html::a('Cancelar', \yii\helpers\Url::previous(), ['class' => 'btn btn-default']) ?>
        <?php ActiveForm::end(); ?>

    </div>

</div>
