<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "TipoAtributo".
 *
 * @property integer $idTipoAtributo
 * @property string $Tipo
 * @property string $Descricao
 *
 * @property Atributo[] $atributos
 */
class TipoAtributo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TipoAtributo';
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
            [['Tipo'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoAtributo' => Yii::t('app', 'Id Tipo Atributo'),
            'Tipo' => Yii::t('app', 'Tipo'),
            'Descricao' => Yii::t('app', 'Descricao'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtributos()
    {
        return $this->hasMany(\app\models\Atributo::className(), ['idTipoAtributo' => 'idTipoAtributo']);
    }
}
