<?php

/**
 * Description of ActiveField
 *
 * @author Schvarcz
 */

namespace app\widgets\AtributosEspecie;

use yii\helpers\Html;

class ActiveField extends \yii\bootstrap\ActiveField
{
    public function textInput($options = array())
    {
        $options = array_merge($this->inputOptions, $options);
        $this->adjustLabelFor($options);
        $this->parts['{input}'] = Html::activeTextInput($this->model, $this->attribute, $options);

        return $this;
    }
}
