<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "TipoDescritor".
 */
class TipoDescritor extends \app\models\base\TipoDescritor
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoDescritor' => Yii::t('app', 'Identificador do Tipo de Descritor'),
            'Tipo' => Yii::t('app', 'Tipo de Descritor'),
            'Descricao' => Yii::t('app', 'Descrição'),
        ];
    }

}
