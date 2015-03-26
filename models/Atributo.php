<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Atributo".
 */
class Atributo extends \app\models\base\Atributo
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idAtributo' => Yii::t('app', 'Identificador do Atributo'),
            'Nome' => Yii::t('app', 'Nome'),
            'idTipoDado' => Yii::t('app', 'Tipo de dado'),
            'idTipoAtributo' => Yii::t('app', 'Tipo de atributo'),
            'Descricao' => Yii::t('app', 'Descrição'),
        ];
    }
}
