<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Familia".
 */
class Familia extends \app\models\base\Familia
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idFamilia' => Yii::t('app', 'Identificado da Família'),
            'NomeCientifico' => Yii::t('app', 'Nome Científico'),
            'Descricao' => Yii::t('app', 'Descrição'),
            'idOrdem' => Yii::t('app', 'Ordem'),
        ];
    }
}
