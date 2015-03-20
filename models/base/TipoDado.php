<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "TipoDado".
 *
 * @property integer $idTipoDado
 * @property string $Tipo
 * @property string $Descricao
 *
 * @property Atributo[] $atributos
 */
class TipoDado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TipoDado';
    }
    
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->Tipo;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Tipo'], 'required'],
            [['Descricao'], 'string'],
            [['Tipo'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoDado' => Yii::t('app', 'Id Tipo Dado'),
            'Tipo' => Yii::t('app', 'Tipo'),
            'Descricao' => Yii::t('app', 'Descricao'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtributos()
    {
        return $this->hasMany(\app\models\Atributo::className(), ['idTipoDado' => 'idTipoDado']);
    }
}
