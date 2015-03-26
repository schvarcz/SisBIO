<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Coleta".
 */
class Coleta extends \app\models\base\Coleta
{
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idColeta' => Yii::t('app', 'Identificador da Coleta'),
            'Data_Coleta' => Yii::t('app', 'Data da Coleta'),
            'Observacao' => Yii::t('app', 'Observação'),
            'idUnidadeGeografica' => Yii::t('app', 'Unidade Geográfica'),
            'coordenadaGeografica' => Yii::t('app', 'Coordenada Geográfica'),
        ];
    }
}
