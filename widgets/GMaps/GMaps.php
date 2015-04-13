<?php

namespace app\widgets\GMaps;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;
use yii\bootstrap\Modal;
use yii\bootstrap\Button;

/**
 * Class GMaps
 *
 * @author Guilherme Schvarcz Franco <guilhermefrancosi@gmail.com>
 */
class GMaps extends InputWidget
{
    /**
     * @var array the HTML attributes for the input tag.
     */
    public $options = [];
    /**
     * @var array options for GMaps
     */
    public $clientOptions = [];
    /**
     * @var array events for GMaps
     */
    public $clientEvents = [];

    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->hasModel() ? Html::getInputId($this->model, $this->attribute) : $this->getId();
        }
    }

    public function run()
    {
        $id = $this->options['id'];
        $view = $this->getView();
        GMapsAsset::register($view);
        
        $this->renderWidgets();
        
        $options = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
        $js = "jQuery('#$id').gmaps($options)";
        foreach ($this->clientEvents as $event => $handler) {
            $js .= ".on('$event', $handler)";
        }
        $view->registerJs($js . ';');
        

    }
    
    public function renderWidgets()
    {
        
        $id = $this->options['id'];
        if ($this->hasModel()) {
            echo Html::activeHiddenInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::hiddenInput($this->name, $this->value, $this->options);
        }
        
        Modal::begin([
            'header' => '<h2>Informar coordenadas geográficas</h2>',
            'toggleButton' => ['label' => 'Informar coordenadas por texto.', 'tag' => 'a'],
            'footer' => Button::widget([
                            'label'=>'Atualizar',
                            'clientEvents' => [
                                'click' => "function(e) { return jQuery('#$id').gmaps('updateMap',$('.coordsInfo').val());}"
                            ],
                            'options' => [
                                'class' => 'btn-primary',
                                'data-dismiss' => 'modal'
                            ]]),
        ]);
        echo Html::tag("h5","Informe as coordenadas geográficas separadas por virgula. Um coordenada por linha. ". Html::tag("br") . Html::tag("em",Html::tag("small","Ex: 57.08, 56.98 ")));

        echo Html::textarea("Coords","",["style"=>"width:100%;height:200px;", "class" => "coordsInfo"]);

        Modal::end();
    }           
}
