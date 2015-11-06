<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "exportacao".
 *
 * @property integer $idexportacoes
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
            [['idexportacoes', 'idPesquisador'], 'required'],
            [['idexportacoes', 'percent', 'idPesquisador'], 'integer'],
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
            'idexportacoes' => Yii::t('app', 'Idexportacoes'),
            'sql' => Yii::t('app', 'Sql'),
            'percent' => Yii::t('app', 'Percent'),
            'file' => Yii::t('app', 'File'),
            'idPesquisador' => Yii::t('app', 'Id Pesquisador'),
        ];
    }
}
