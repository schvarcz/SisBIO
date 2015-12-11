<?php

namespace app\widgets\ExportingLoadbar;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\bootstrap\Widget;

/**
 * Class ExportingLoadbar
 *
 * @author Guilherme Schvarcz Franco <guilhermefrancosi@gmail.com>
 */
class ExportingLoadbar extends Widget
{

    /**
     * @var array the HTML attributes for the input tag.
     */
    public $options = [];
    
    public $model = NULL;

    /**
     * @var array options for ExportingLoadbar
     */
    public $clientOptions = [];

    /**
     * @var array events for ExportingLoadbar
     */
    public $clientEvents = [];

    public function init()
    {
        parent::init();
        if (!isset($this->options['id']))
        {
            $this->options['id'] = $this->getId();
        }
    }

    public function run()
    {
        $id = $this->options['id'];
        $view = $this->getView();
        ExportingLoadbarAsset::register($view);

        $this->renderWidgets();

        $options = empty($this->clientOptions) ? '' : Json::encode($this->clientOptions);
        $js = "jQuery('#$id').exportingloadbar($options)";
        foreach ($this->clientEvents as $event => $handler)
        {
            $js .= ".on('$event', $handler)";
        }
        $view->registerJs($js . ';');
    }

    public function renderWidgets()
    {

        //<div class="progress">
        //    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
        //        <span class="sr-only">60% Complete</span>
        //    </div>
        //</div>
        $id = $this->options['id'];
        echo Html::tag("div",
            Html::tag("div",
                    ($this->model->percent*100)."%",
                    ["id"=>$id, "class"=>"progress-bar","data-id"=>$this->model->primaryKey,"role"=>"progressbar","aria-valuemin"=>0,"aria-valuemax"=>100, "style"=>"width:".($this->model->percent*100)."%"]
            ),
            ["class"=>"progress"]
        );
    }

}
