<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TipoAtributo".
 */
class TipoAtributo extends \app\models\base\TipoAtributo
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoAtributo' => Yii::t('app', 'Identificador do Tipo de Atributo'),
            'Tipo' => Yii::t('app', 'Tipo de Atributo'),
            'Descricao' => Yii::t('app', 'Descrição'),
        ];
    }
}
