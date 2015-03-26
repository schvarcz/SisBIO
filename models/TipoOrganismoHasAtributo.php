<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TipoOrganismo_has_Atributo".
 */
class TipoOrganismoHasAtributo extends \app\models\base\TipoOrganismoHasAtributo
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoOrganismo' => Yii::t('app', 'Tipo de Organismo'),
            'idAtributo' => Yii::t('app', 'Atributo'),
        ];
    }
}
