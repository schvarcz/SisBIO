<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\JsExpression;
use kartik\select2\Select2;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;
use yii\bootstrap\Collapse;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var app\models\Coleta $model
 * @var yii\widgets\ActiveForm $form
 */
$this->registerJsFile(Yii::$app->homeUrl . "js/coletaPlugin.js", [ "depends" => ['yii\jui\JuiAsset']]);
$this->registerJsFile(Yii::$app->homeUrl . "js/coleta.js", [ "depends" => ['yii\web\JqueryAsset']]);
$this->registerCssFile(Yii::$app->homeUrl . "css/coleta.css");
$script = <<<END
        jQuery(".plus-coleta-individuo").coletaPlus({
            container: ".coletaIndividuosContainer",
            modalAtributos: ".modalColetaIndividuos",
            inputName: "especie_add",
            ajax: {
                url: "http://localhost/sisbio/web/coleta/adddescritor?tipoDescritor=1"
            }
        });
END;
$this->registerJs($script);

$script = <<<END
        jQuery(".plus-coleta-populacao").coletaPlus({
            container: ".coletaPopulacaoContainer",
            modalAtributos: ".modalColetaPopulacao",
            inputName: "populacao_add",
            ajax: {
                url: "http://localhost/sisbio/web/coleta/adddescritor?tipoDescritor=2"
            }
        });
END;
$this->registerJs($script);

$script = <<<END
        jQuery(".plus-coleta-ecossistema").coletaPlus({
            container: ".coletaEcossistemaContainer",
            inputName: "ecossistemas_add",
            uniqueWidget:true,
            uniqueId: "#coletaitempropriedade-iddescritor",
            ajax: {
                url: "http://localhost/sisbio/web/coleta/adddescritoresambiental?tipoDescritor=3"
            }
        });
END;
$this->registerJs($script);

?>

<div class="coleta-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal', 'enableClientValidation' => false]); ?>

    <div class="">
        <?php echo $form->errorSummary($model); ?>

        <p>

        <div class="form-group ">
            <?=
            \app\widgets\GMaps\GMaps::widget([
                "name" => "map",
                "value" => $model->idUnidadeGeografica0->shape,
                'options' => ['class' => 'form-control maps'],
                'clientOptions' => [
                    "mapsOptions" => [
                        "zoom" => 8,
                        "center" => $model->idUnidadeGeografica0 ? $model->idUnidadeGeografica0->getShapeCenter() : [-30.0393227, -51.2325482]
                    ]
                ]
            ]);
            ?>
        </div>
        <?= 
            Html::activeHiddenInput($model,'idPesquisadorRegistro',['value'=> Yii::$app->user->id]);
        ?>
        <?=
        $form->field($model, 'Data_Coleta')->widget(\app\widgets\DateTime\DateTimePicker::classname(), [
            'options' => ['class' => 'form-control'],
            'pluginOptions' => [
                'autoclose' => true,
                'todayHighlight' => true,
            ]
        ]);
        ?>
        <?=
        $form->field($model, 'idUnidadeGeografica')->widget(\app\widgets\Select2Active\Select2Active::classname(), [
            'options' => ['placeholder' => 'Nome da unidade geográfica'],
            'pluginOptions' => [
                'allowClear' => true,
                'ajax' => [
                    'url' => yii\helpers\Url::to(["unidade-geografica/findug"]),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(term,page) { return {nomeUnidadeGeografica:term.term}; }'),
                    'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                ],
                'initSelection' => true
            ],
        ]);
        ?>
        <?=
        $form->field($model, 'idMetodo')->widget(\app\widgets\Select2Active\Select2Active::classname(), [
            'options' => ['placeholder' => 'Método de coleta'],
            'pluginOptions' => [
                'allowClear' => true,
                'ajax' => [
                    'url' => yii\helpers\Url::to(["tipo-organismo/findmetodos"]),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(term,page) { return {nomeMetodo:term.term}; }'),
                    'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                ],
                'initSelection' => true
            ],
            'pluginEvents' => [
                'select2:open' => 'function(e) { methodsMetodo.open(); }',
                'select2:close' => 'function(e) { methodsMetodo.close(); }',
                'select2:select' => 'function(e) { methodsMetodo.select(e); }',
                "select2:unselect" => "function(e) { methodsMetodo.unselect(); }"
            ],
        ]);
        ?>
        <?=
        $form->field($model, 'idPesquisadores')->widget(\app\widgets\Select2Active\Select2Active::classname(), [
            'options' => [
                "multiple" => true,
                'disabled' => true
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
        <?= $form->field($model, 'Observacao')->textarea(['rows' => 6]) ?>
        <?= $form->field($model, 'coordenadaGeografica')->textInput() ?>

        </p>

        <?php $this->beginBlock('individuo'); ?>
        <br/>
        <div class="form-group">
            <label class="control-label col-sm-3">Novo indivíduo</label>
            <div class = "col-sm-6">
                <?=
                Select2::widget([
                    'name' => 'especie_add',
                    'options' => [
                        'placeholder' => 'Selecione a espécie a ser adicionada',
                        'class' => 'plus-coleta-input',
                        'disabled' => true
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 0,
                        'ajax' => [
                            'url' => yii\helpers\Url::to(["coleta/findesp"]),
                            'dataType' => 'json',
                            'data' => new JsExpression('function(term,page) { return {nomeEspecie:term.term, idTipoOrganismo:idTipoOrganismo}; }'), //idTipoOrganismo é uma variável global definida no arquivo web/js/coleta.js
                            'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                        ]
                    ],
                    'addon' => [
                        'append' => [
                            'content' => Html::button('<span class="glyphicon glyphicon-plus"></span>', [
                                'class' => 'btn btn-primary plus-coleta plus-coleta-individuo',
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

            <label class="control-label col-sm-3"></label>
            <?php
            Modal::begin([
                'header' => '<h2>Atributos funcionais</h2>',
                'toggleButton' => ['label' => '<div class = "col-sm-6">Atributos funcionais que serão informados.</div>', 'tag' => 'a'],
                'footer' => Button::widget([
                    'label' => 'Atualizar',
                    'options' => [
                        'class' => 'btn-primary updateFields',
                        'data-dismiss' => 'modal'
                    ]
                ]),
                'options' => [
                    "class" => "modalColetaIndividuos"
                ],
            ]);
            echo Html::tag("h5", "Selecionar todos os atributos que irá informar. ");
            echo Html::tag("div", "Para poder selecionar os atributos que foram coletados, por favor, primeiro selecione um método de coleta para especificar a espécie.",["class"=>"bg-danger"]);

            $organismos = \app\models\TipoOrganismo::find()->all();
            $items = [];
            foreach ($organismos as $organismo)
            {
                $models = $organismo->getIdDescritores()->andWhere(["idTipoDescritor" => 1])->all();
                $items[] = [
                    "label" => $organismo->label,
                    "content" => $this->render('_descritores', ['models' => $models, "organismo" => $organismo]),
                    "options" => ["style" => "display:none"]
                ];
            }

            echo Collapse::widget([
                'items' => $items
            ]);
            Modal::end();
            ?>
        </div>
        <div class="form-group">
            <div class = "col-sm-12 coletaIndividuosContainer">
                <?=
                \app\widgets\DescritoresEspecie\DescritoresEspecie::widget(["name" => "especie", "model" => $model, "tipoDescritor" => 1]);
                ?>
            </div>
        </div>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('populacao'); ?>
        <br/>
        <div class="form-group">
            <label class="control-label col-sm-3">Nova População</label>
            <div class = "col-sm-6">
                <?=
                Select2::widget([
                    'name' => 'populacao_add',
                    'data' => $data,
                    'options' => [
                        'placeholder' => 'Selecione a espécie a ser adicionada',
                        'class' => 'plus-coleta-input',
                        'disabled' => true
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 0,
                        'ajax' => [
                            'url' => yii\helpers\Url::to(["coleta/findesp"]),
                            'dataType' => 'json',
                            'data' => new JsExpression('function(term,page) { return {nomeEspecie:term.term, idTipoOrganismo:idTipoOrganismo}; }'), //idTipoOrganismo é uma variável global definida no arquivo web/js/coleta.js
                            'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                        ]
                    ],
                    'addon' => [
                        'append' => [
                            'content' => Html::button('<span class="glyphicon glyphicon-plus"></span>', [
                                'class' => 'btn btn-primary plus-coleta plus-coleta-populacao',
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

            <label class="control-label col-sm-3"></label>
            <?php
            Modal::begin([
                'header' => '<h2>Atributos da população</h2>',
                'toggleButton' => ['label' => '<div class = "col-sm-6">Atributos da população que serão informados.</div>', 'tag' => 'a'],
                'footer' => Button::widget([
                    'label' => 'Atualizar',
                    'options' => [
                        'class' => 'btn-primary updateFields',
                        'data-dismiss' => 'modal'
                    ]
                ]),
                'options' => [
                    "class" => "modalColetaPopulacao"
                ],
            ]);
            echo Html::tag("h5", "Selecionar todos os atributos que irá informar. ");
            echo Html::tag("div", "Para poder selecionar os atributos que foram coletados, por favor, primeiro selecione um método de coleta para especificar a espécie.",["class"=>"bg-danger"]);
            
            $items = [];
            foreach ($organismos as $organismo)
            {
                $models = $organismo->getIdDescritores()->andWhere(["idTipoDescritor" => 2,])->all();
                $items[] = [
                    "label" => $organismo->label,
                    "content" => $this->render('_descritores', ['models' => $models, "organismo" => $organismo]),
                    "options" => ["style" => "display:none"]
                ];
            }

            echo Collapse::widget([
                'items' => $items
            ]);
            Modal::end();
            ?>
        </div>

        <div class="form-group">
            <div class = "col-sm-12 coletaPopulacaoContainer">
                <?=
                \app\widgets\DescritoresEspecie\DescritoresEspecie::widget(["name" => "especie", "model" => $model, "tipoDescritor" => 2]);
                ?>
            </div>
        </div>
        <?php $this->endBlock(); ?>

        <?php $this->beginBlock('ecossistemas'); ?>
        <br/>
        <div class="form-group">
            <label class="control-label col-sm-3">Variáveis Ecossitêmicas</label>
            <div class = "col-sm-6">
                <?=
                Select2::widget([
                    'name' => 'ecossistemas_add',
                    'data' => $data,
                    'options' => [
                        'placeholder' => 'Selecione a variável ecossistêmica a ser adicionada',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 0,
                        'ajax' => [
                            'url' => yii\helpers\Url::to(["coleta/findvariavelecossistemica"]),
                            'dataType' => 'json',
                            'data' => new JsExpression('function(term,page) { return {nomeDescritor:term.term}; }'),
                            'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
                        ]
                    ],
                    'addon' => [
                        'append' => [
                            'content' => Html::button('<span class="glyphicon glyphicon-plus"></span>', [
                                'class' => 'btn btn-primary plus-coleta plus-coleta-ecossistema',
                                'title' => 'Adiciona a variável ecossistêmica a sua coleta',
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
            <div class = "col-sm-12 coletaEcossistemaContainer">
                <?=
                \app\widgets\DescritoresEspecie\DescritoresEspecie::widget(["name" => "variavel-ambiental", "model" => $model, "tipoDescritor" => 3]);
                ?>
            </div>
        </div>
        <?php $this->endBlock(); ?>

        <?=
        \yii\bootstrap\Tabs::widget(
                [
                    'encodeLabels' => false,
                    'items' => [ [
                            'label' => 'Individuo',
                            'content' => $this->blocks['individuo'],
                            'active' => true,
                        ], [
                            'label' => 'População',
                            'content' => $this->blocks['populacao'],
                            'active' => false,
                        ], [
                            'label' => 'Ecossistemas',
                            'content' => $this->blocks['ecossistemas'],
                            'active' => false,
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
