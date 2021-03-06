<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TipoOrganismo".
 */
class TipoOrganismo extends \app\models\base\TipoOrganismo
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoOrganismo' => Yii::t('app', 'Identificador do Tipo de Organismo'),
            'Nome' => Yii::t('app', 'Nome do Tipo de Organismo'),
            'Descricao' => Yii::t('app', 'Descrição'),
            'idDescritores' => Yii::t('app', 'Descritores'),
            'idMetodos' => Yii::t('app', 'Métodos de Coleta'),
        ];
    }

}
