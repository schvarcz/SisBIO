<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "ColetaItem".
 *
 * @property integer $idColetaItem
 * @property integer $idColeta
 * @property integer $idEspecie
 *
 * @property Coleta $idColeta0
 * @property Especie $idEspecie0
 * @property ColetaItemPropriedade[] $coletaItemPropriedades
 */
class ColetaItem extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ColetaItem';
    }
    
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->idColeta;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idColeta', 'idEspecie'], 'required'],
            [['idColeta', 'idEspecie'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idColetaItem' => Yii::t('app', 'Id Coleta Item'),
            'idColeta' => Yii::t('app', 'Id Coleta'),
            'idEspecie' => Yii::t('app', 'Id Especie'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdColeta0()
    {
        return $this->hasOne(\app\models\Coleta::className(), ['idColeta' => 'idColeta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEspecie0()
    {
        return $this->hasOne(\app\models\Especie::className(), ['idEspecie' => 'idEspecie']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColetaItemPropriedades()
    {
        return $this->hasMany(\app\models\ColetaItemPropriedade::className(), ['idColetaItem' => 'idColetaItem']);
    }
}
