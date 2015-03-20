<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "TipoOrganismo_has_Atributo".
 *
 * @property integer $idTipoOrganismo
 * @property integer $idAtributo
 *
 * @property ColetaItemPropriedade[] $coletaItemPropriedades
 * @property TipoOrganismo $idTipoOrganismo0
 * @property Atributo $idAtributo0
 */
class TipoOrganismoHasAtributo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TipoOrganismo_has_Atributo';
    }
    
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->idAtributo;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTipoOrganismo', 'idAtributo'], 'required'],
            [['idTipoOrganismo', 'idAtributo'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoOrganismo' => Yii::t('app', 'Id Tipo Organismo'),
            'idAtributo' => Yii::t('app', 'Id Atributo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColetaItemPropriedades()
    {
        return $this->hasMany(\app\models\ColetaItemPropriedade::className(), ['idTipoOrganismo' => 'idTipoOrganismo', 'idAtributo' => 'idAtributo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoOrganismo0()
    {
        return $this->hasOne(\app\models\TipoOrganismo::className(), ['idTipoOrganismo' => 'idTipoOrganismo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAtributo0()
    {
        return $this->hasOne(\app\models\Atributo::className(), ['idAtributo' => 'idAtributo']);
    }
}
