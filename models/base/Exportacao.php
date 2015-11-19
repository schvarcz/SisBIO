<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "exportacao".
 *
 * @property integer $idExportacao
 * @property string $sql
 * @property integer $percent
 * @property string $file
 * @property integer $idPesquisador
 */
class Exportacao extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Exportacao';
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
            [['idPesquisador'], 'required'],
            [['percent', 'idPesquisador'], 'integer'],
            [['sql'], 'string'],
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
        ];
    }
}
