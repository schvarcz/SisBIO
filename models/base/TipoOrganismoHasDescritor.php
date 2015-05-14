<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "TipoOrganismo_has_Descritor".
 *
 * @property integer $idTipoOrganismo
 * @property integer $idDescritor
 *
 * @property ColetaItemPropriedade[] $coletaItemPropriedades
 * @property TipoOrganismo $idTipoOrganismo0
 * @property Descritor $idDescritor0
 */
class TipoOrganismoHasDescritor extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TipoOrganismo_has_Descritor';
    }
    
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->idDescritor;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTipoOrganismo', 'idDescritor'], 'required'],
            [['idTipoOrganismo', 'idDescritor'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoOrganismo' => Yii::t('app', 'Id Tipo Organismo'),
            'idDescritor' => Yii::t('app', 'Id Descritor'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColetaItemPropriedades()
    {
        return $this->hasMany(\app\models\ColetaItemPropriedade::className(), ['idTipoOrganismo' => 'idTipoOrganismo', 'idDescritor' => 'idDescritor']);
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
    public function getIdDescritor0()
    {
        return $this->hasOne(\app\models\Descritor::className(), ['idDescritor' => 'idDescritor']);
    }
}
