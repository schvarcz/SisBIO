<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "TipoOrganismo_has_Metodo".
 *
 * @property integer $idTipoOrganismo
 * @property integer $idMetodo
 */
class TipoOrganismoHasMetodo extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TipoOrganismo_has_Metodo';
    }
    
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->idMetodo;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTipoOrganismo', 'idMetodo'], 'required'],
            [['idTipoOrganismo', 'idMetodo'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoOrganismo' => Yii::t('app', 'Id Tipo Organismo'),
            'idMetodo' => Yii::t('app', 'Id Metodo'),
        ];
    }
}
