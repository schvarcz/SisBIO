<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Metodo".
 */
class Metodo extends \app\models\base\Metodo
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idMetodo' => Yii::t('app', 'Identificador do Método'),
            'Nome' => Yii::t('app', 'Nome'),
            'Descricao' => Yii::t('app', 'Descrição'),
        ];
    }
}
