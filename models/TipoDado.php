<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TipoDado".
 */
class TipoDado extends \app\models\base\TipoDado
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoDado' => Yii::t('app', 'Identificador do Tipo de Dado'),
            'Tipo' => Yii::t('app', 'Tipo de Dado'),
            'Descricao' => Yii::t('app', 'Descrição'),
        ];
    }
}
