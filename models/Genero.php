<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Genero".
 */
class Genero extends \app\models\base\Genero
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idGenero' => Yii::t('app', 'Identificador do Gênero'),
            'NomeCientifico' => Yii::t('app', 'Nome Científico'),
            'Descricao' => Yii::t('app', 'Descrição'),
            'idFamilia' => Yii::t('app', 'Família'),
        ];
    }

}
