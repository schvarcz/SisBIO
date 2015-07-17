<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "TipoOrganismo_has_Descritor".
 *
 * @property integer $idTipoOrganismo
 * @property integer $idDescritor
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

}
