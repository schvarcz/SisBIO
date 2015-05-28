<?php

/**
 * Description of Select2Active
 *
 * @author Schvarcz
 */

namespace app\widgets\Select2Active;

use kartik\select2\Select2;

class Select2Active extends Select2
{

    public function init()
    {
        if (!empty($this->pluginOptions['initSelection']))
        {
            $initConfigs = [
                "url" => "",
                "dataName" => "id",
                "returnData" => "data.results"
            ];
            
            if(is_string($this->pluginOptions['initSelection']))
                $initConfigs["url"] = $this->pluginOptions['initSelection'];
            elseif(is_array($this->pluginOptions['initSelection']))
            {
                foreach($this->pluginOptions['initSelection'] as $key => $value)
                    $initConfigs[$key] = $value;
            }
            
            if( $initConfigs["url"] == "")
            {
                if(!empty($this->pluginOptions['ajax']) && !empty($this->pluginOptions['ajax']['url']))
                    $initConfigs["url"] = $this->pluginOptions['ajax']["url"];
                else
                {
                    parent::init();
                    return;
                }
            }
            if($this->hasModel())
            {
                $model = $this->model;
                $relation = $model->getRelation($this->attribute,false);
                if($relation->multiple)
                {
                    $attr = $this->attribute;
                    $data = $model->$attr;
                    $dataR = [];
                    
                    foreach( $data as $modelRelation)
                    {
                        $dataR[$modelRelation->primaryKey] = $modelRelation->label;
                    }
                    $this->data = $dataR;
                }
            }
            $initScript = <<< SCRIPT
function (element, callback) {
    var id=\$(element).val();
    if (id !== "") {
        \$.ajax("{$initConfigs["url"]}?{$initConfigs["dataName"]}=" + id, {
            dataType: "json"
        }).done(function(data) { callback({$initConfigs["returnData"]});});
    }
}
SCRIPT;

            $this->pluginOptions['initSelection'] = new \yii\web\JsExpression($initScript);
        }
        
        parent::init();
        
    }

}
