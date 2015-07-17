<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "CronTask".
 *
 * @property integer $idCronTask
 * @property string $Task
 *
 * @property Pesquisador[] $pesquisadors
 */
class CronTask extends \app\models\MActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'CronTask';
    }

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->Task;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Task'], 'required'],
            [['Task'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idCronTask' => Yii::t('app', 'Id Cron Task'),
            'Task' => Yii::t('app', 'Task'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesquisadors()
    {
        return $this->hasMany(\app\models\Pesquisador::className(), ['idCronTask' => 'idCronTask']);
    }

}
