<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "TipoDescritor".
 *
 * @property integer $idTipoDescritor
 * @property string $Tipo
 * @property string $Descricao
 *
 * @property Descritor[] $descritores
 */
class TipoDescritor extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TipoDescritor';
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
            'idTipoDescritor' => Yii::t('app', 'Id Tipo Descritor'),
            'Tipo' => Yii::t('app', 'Tipo'),
            'Descricao' => Yii::t('app', 'Descricao'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDescritores()
    {
        return $this->hasMany(\app\models\Descritor::className(), ['idTipoDescritor' => 'idTipoDescritor']);
    }
}
