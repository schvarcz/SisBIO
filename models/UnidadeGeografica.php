<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "UnidadeGeografica".
 */
class UnidadeGeografica extends \app\models\base\UnidadeGeografica
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUnidadeGeografica' => Yii::t('app', 'Identificador da Unidade Geográfica'),
            'Nome' => Yii::t('app', 'Nome'),
            'shape' => Yii::t('app', 'Shape'),
            'Data_Criacao' => Yii::t('app', 'Data de Criação'),
            'idProjeto' => Yii::t('app', 'Projeto'),
            'idPesquisador' => Yii::t('app', 'Pesquisador'),
            'idUnidadeGeograficaPai' => Yii::t('app', 'Unidade Geográfica Pai'),
        ];
    }
}
