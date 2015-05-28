<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Descritor".
 */
class Descritor extends \app\models\base\Descritor
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idDescritor' => Yii::t('app', 'Identificador do Descritor'),
            'Nome' => Yii::t('app', 'Nome'),
            'idTipoDado' => Yii::t('app', 'Tipo de dado'),
            'idTipoDescritor' => Yii::t('app', 'Tipo de Descritor'),
            'Descricao' => Yii::t('app', 'Descrição'),
        ];
    }
}
