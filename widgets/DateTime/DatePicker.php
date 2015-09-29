<?php

use kartik\widgets\DatePicker;
namespace app\widgets\DateTime;

/**
 * Description of DatePicker
 *
 * @author Schvarcz
 */
class DatePicker extends \kartik\widgets\DatePicker
{
    public $type = DatePicker::TYPE_COMPONENT_APPEND;

    public function init()
    {
        if (!isset($this->language))
            $this->language = \Yii::$app->formatter->locale;

        parent::init();
    }
}
