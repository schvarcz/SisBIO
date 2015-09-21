<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "Projeto".
 *
 * @property integer $idProjeto
 * @property string $Nome
 * @property string $Data_Inicio
 * @property string $Data_Fim
 * @property integer $ativo
 * @property integer $idPesquisadorResponsavel
 * @property string $Descricao
 * @property integer $idProjetoPai
 *
 * @property PesquisadorHasPermissoes[] $pesquisadorHasPermissoes
 * @property Pesquisador[] $pesquisadoresWhoHasPermissoes
 * @property PesquisadorHasProjeto[] $pesquisadorHasProjetos
 * @property Pesquisador[] $idPesquisadores
 * @property Pesquisador $idPesquisadorResponsavel0
 * @property Projeto $idProjetoPai0
 * @property Projeto[] $projetos
 * @property UnidadeGeografica[] $unidadeGeograficas
 */
class Projeto extends \app\models\MActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Projeto';
    }

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->Nome;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nome', 'Data_Inicio', 'idPesquisadorResponsavel'], 'required'],
            [['Data_Inicio', 'Data_Fim'], 'safe'],
            [['ativo', 'idPesquisadorResponsavel', 'idProjetoPai'], 'integer'],
            [['Descricao'], 'string'],
            [['Nome'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idProjeto' => Yii::t('app', 'Id Projeto'),
            'Nome' => Yii::t('app', 'Nome'),
            'Data_Inicio' => Yii::t('app', 'Data  Inicio'),
            'Data_Fim' => Yii::t('app', 'Data  Fim'),
            'ativo' => Yii::t('app', 'Ativo'),
            'idPesquisadorResponsavel' => Yii::t('app', 'Id Pesquisador Responsavel'),
            'Descricao' => Yii::t('app', 'Descricao'),
            'idProjetoPai' => Yii::t('app', 'Id Projeto Pai'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesquisadorHasPermissoes()
    {
        return $this->hasMany(\app\models\PesquisadorHasPermissoes::className(), ['idProjeto' => 'idProjeto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesquisadoresWhoHasPermissoes()
    {
        return $this->hasMany(\app\models\Pesquisador::className(), ['idPesquisador' => 'idPesquisador'])->viaTable("Pesquisador_has_Permissoes", ['idProjeto' => 'idProjeto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesquisadorHasProjetos()
    {
        return $this->hasMany(\app\models\PesquisadorHasProjeto::className(), ['idProjeto' => 'idProjeto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPesquisadores()
    {
        return $this->hasMany(\app\models\Pesquisador::className(), ['idPesquisador' => 'idPesquisador'])->viaTable('Pesquisador_has_Projeto', ['idProjeto' => 'idProjeto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPesquisadorResponsavel0()
    {
        return $this->hasOne(\app\models\Pesquisador::className(), ['idPesquisador' => 'idPesquisadorResponsavel']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProjetoPai0()
    {
        return $this->hasOne(\app\models\Projeto::className(), ['idProjeto' => 'idProjetoPai']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjetos()
    {
        return $this->hasMany(\app\models\Projeto::className(), ['idProjetoPai' => 'idProjeto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadeGeograficas()
    {
        return $this->hasMany(\app\models\UnidadeGeografica::className(), ['idProjeto' => 'idProjeto']);
    }

}
