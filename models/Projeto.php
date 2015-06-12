<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Projeto".
 */
class Projeto extends \app\models\base\Projeto
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idProjeto' => Yii::t('app', 'Identificador do Projeto'),
            'Nome' => Yii::t('app', 'Nome'),
            'Data_Inicio' => Yii::t('app', 'Data de Início'),
            'Data_Fim' => Yii::t('app', 'Data de Fim'),
            'ativo' => Yii::t('app', 'Ativo'),
            'idPesquisadorResponsavel' => Yii::t('app', 'Pesquisador Responsável'),
            'idPesquisadores' => Yii::t('app', 'Pesquisadores Envolvidos'),
            'Descricao' => Yii::t('app', 'Descrição'),
        ];
    }
}
