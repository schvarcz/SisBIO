<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Projeto".
 * @property Pesquisador[] $pesquisadoresWhoHasPermissoes
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
            'idPesquisadores' => Yii::t('app', 'Pesquisadores Colaborador'),
            'Descricao' => Yii::t('app', 'Descrição'),
            'idProjetoPai' => Yii::t('app', 'Projeto Pai'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViewPesquisadorPermissoes()
    {
        return $this->hasMany(\app\models\Viewpesquisadorpermissoes::className(), ['idProjeto' => 'idProjeto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesquisadoresWhoHasPermissoes()
    {
        return $this->hasMany(\app\models\Pesquisador::className(), ['idPesquisador' => 'idPesquisador'])->viaTable("Pesquisador_has_Permissoes", ['idProjeto' => 'idProjeto']);
    }

}
