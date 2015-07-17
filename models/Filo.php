<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Filo".
 */
class Filo extends \app\models\base\Filo
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idFilo' => Yii::t('app', 'Identificador do Filo'),
            'NomeCientifico' => Yii::t('app', 'Nome Científico'),
            'Descricao' => Yii::t('app', 'Descrição'),
        ];
    }

}
