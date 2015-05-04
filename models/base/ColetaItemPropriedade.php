<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "ColetaItemPropriedade".
 *
 * @property integer $idColetaItemPropriedade
 * @property integer $idColetaItem
 * @property integer $idTipoOrganismo
 * @property integer $idAtributo
 * @property string $value
 * @property integer $impossivelColetar
 *
 * @property ColetaItem $idColetaItem0
 * @property TipoOrganismoHasAtributo $idTipoOrganismoHasAtributo
 * @property TipoOrganismo $idTipoOrganismo0
 * @property Atributo $idAtributo0
 */
class ColetaItemPropriedade extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ColetaItemPropriedade';
    }
    
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->idColetaItem;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idColetaItem', 'idTipoOrganismo', 'idAtributo'], 'required'],
            [['idColetaItem', 'idTipoOrganismo', 'idAtributo', 'impossivelColetar'], 'integer'],
            [['value'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idColetaItemPropriedade' => Yii::t('app', 'Id Coleta Item Propriedade'),
            'idColetaItem' => Yii::t('app', 'Id Coleta Item'),
            'idTipoOrganismo' => Yii::t('app', 'Id Tipo Organismo'),
            'idAtributo' => Yii::t('app', 'Id Atributo'),
            'value' => Yii::t('app', 'Value'),
            'impossivelColetar' => Yii::t('app', 'Impossivel Coletar'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdColetaItem0()
    {
        return $this->hasOne(\app\models\ColetaItem::className(), ['idColetaItem' => 'idColetaItem']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoOrganismoHasAtributo()
    {
        return $this->hasOne(\app\models\TipoOrganismoHasAtributo::className(), ['idTipoOrganismo' => 'idTipoOrganismo', 'idAtributo' => 'idAtributo']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAtributo0()
    {
        return $this->hasOne(\app\models\Atributo::className(), ['idAtributo' => 'idAtributo']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoOrganismo0()
    {
        return $this->hasOne(\app\models\TipoOrganismo::className(), ['idTipoOrganismo' => 'idTipoOrganismo']);
    }
}
