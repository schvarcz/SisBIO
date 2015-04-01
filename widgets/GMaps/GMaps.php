<?php

namespace app\widgets\GMaps;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

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
        if ($this->hasModel()) {
            echo Html::activeHiddenInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::hiddenInput($this->name, $this->value, $this->options);
        }
        $id = $this->options['id'];
        $view = $this->getView();
        GMapsAsset::register($view);
        $options = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
        $js = "jQuery('#$id').gmaps($options)";
        foreach ($this->clientEvents as $event => $handler) {
            $js .= ".on('$event', $handler)";
        }
        $view->registerJs($js . ';');
    }
}
