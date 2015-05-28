<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TipoOrganismo_has_Descritor".
 */
class TipoOrganismoHasDescritor extends \app\models\base\TipoOrganismoHasDescritor
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoOrganismo' => Yii::t('app', 'Tipo de Organismo'),
            'idDescritor' => Yii::t('app', 'Descritor'),
        ];
    }
}
