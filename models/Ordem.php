<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Ordem".
 */
class Ordem extends \app\models\base\Ordem
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idOrdem' => Yii::t('app', 'Identificador da Ordem'),
            'NomeCientifico' => Yii::t('app', 'Nome Científico'),
            'NomeComum' => Yii::t('app', 'Nome Comum'),
            'Descricao' => Yii::t('app', 'Descrição'),
            'idFilo' => Yii::t('app', 'Filo'),
        ];
    }
}
