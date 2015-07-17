<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "Filo".
 *
 * @property integer $idFilo
 * @property string $NomeCientifico
 * @property string $Descricao
 *
 * @property Ordem[] $ordems
 */
class Filo extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Filo';
    }
    
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->NomeCientifico;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NomeCientifico'], 'required'],
            [['Descricao'], 'string'],
            [['NomeCientifico'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idFilo' => Yii::t('app', 'Id Filo'),
            'NomeCientifico' => Yii::t('app', 'Nome Cientifico'),
            'Descricao' => Yii::t('app', 'Descricao'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdems()
    {
        return $this->hasMany(\app\models\Ordem::className(), ['idFilo' => 'idFilo']);
    }
}
