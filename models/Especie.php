<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Especie".
 */
class Especie extends \app\models\base\Especie
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idEspecie' => Yii::t('app', 'Identificador da Espécie'),
            'NomeCientifico' => Yii::t('app', 'Nome Científico'),
            'NomeComum' => Yii::t('app', 'Nome Comum'),
            'Descricao' => Yii::t('app', 'Descrição'),
            'idGenero' => Yii::t('app', 'Gênero'),
            'idTipo_Organismo' => Yii::t('app', 'Tipo de Organismo'),
        ];
    }
}
