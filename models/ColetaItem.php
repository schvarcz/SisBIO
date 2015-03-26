<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ColetaItem".
 */
class ColetaItem extends \app\models\base\ColetaItem
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idColetaItem' => Yii::t('app', 'Identificador do Item da Coleta'),
            'idColeta' => Yii::t('app', 'Coleta'),
            'idEspecie' => Yii::t('app', 'Espécie'),
        ];
    }
}
