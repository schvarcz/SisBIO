<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Coleta_has_Pesquisador".
 */
class ColetaHasPesquisador extends \app\models\base\ColetaHasPesquisador
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idColeta' => Yii::t('app', 'Coleta'),
            'idPesquisador' => Yii::t('app', 'Pesquisador'),
        ];
    }

}
