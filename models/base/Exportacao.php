<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "exportacao".
 *
 * @property integer $idExportacao
 * @property string $sql
 * @property double $percent
 * @property string $file
 * @property integer $idPesquisador
 * @property string $timestamp
 */
class Exportacao extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exportacao';
    }
    
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->sql;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sql'], 'string'],
            [['percent'], 'number'],
            [['idPesquisador'], 'required'],
            [['idPesquisador'], 'integer'],
            [['timestamp'], 'safe'],
            [['file'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idExportacao' => Yii::t('app', 'Id Exportacao'),
            'sql' => Yii::t('app', 'Sql'),
            'percent' => Yii::t('app', 'Percent'),
            'file' => Yii::t('app', 'File'),
            'idPesquisador' => Yii::t('app', 'Id Pesquisador'),
            'timestamp' => Yii::t('app', 'Timestamp'),
        ];
    }
}
