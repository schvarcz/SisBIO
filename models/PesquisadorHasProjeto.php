<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Pesquisador_has_Projeto".
 */
class PesquisadorHasProjeto extends \app\models\base\PesquisadorHasProjeto
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPesquisador' => Yii::t('app', 'Pesquisador'),
            'idProjeto' => Yii::t('app', 'Projeto'),
        ];
    }

}
