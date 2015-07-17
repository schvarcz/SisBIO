<?php

namespace app\widgets\DateTime;

/**
 * Description of DateTimePicker
 *
 * @author Schvarcz
 */
class DateTimePicker extends \kartik\widgets\DateTimePicker
{

    public $type = \kartik\widgets\DateTimePicker::TYPE_COMPONENT_APPEND;

    public function init()
    {
        if (!isset($this->language))
            $this->language = \Yii::$app->formatter->locale;

        parent::init();
    }

}
