<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "Pesquisador".
 *
 * @property integer $idPesquisador
 * @property string $Nome
 * @property string $email
 * @property string $lattes
 * @property string $authKey
 * @property string $senha
 * @property string $foto
 * @property string $Resumo
 * @property integer $idCronTask
 * @property bool $isAdminBase
 *
 * @property Coleta[] $coletas
 * @property ColetaHasPesquisador[] $coletaHasPesquisadores
 * @property Coleta[] $idColetas
 * @property Curadoria[] $curadorias
 * @property TipoOrganismo[] $idTipoOrganismos
 * @property NaoIdentificado[] $naoIdentificados
 * @property CronTask $idCronTask0
 * @property PesquisadorHasPermissoes[] $pesquisadorHasPermissoes
 * @property PesquisadorHasProjeto[] $pesquisadorHasProjetos
 * @property Projeto[] $idProjetos
 * @property Projeto[] $projetos
 * @property UnidadeGeografica[] $unidadeGeograficas
 * @property AuthAssignment[] $authAssignments
 * @property AuthItem[] $itemNames
 */
class Pesquisador extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Pesquisador';
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
            [['Nome', 'email'], 'required'],
            [['Resumo'], 'string'],
            [['idCronTask', 'isAdminBase'], 'integer'],
            [['Nome', 'email', 'lattes', 'senha', 'foto'], 'string', 'max' => 255],
            [['authKey'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPesquisador' => Yii::t('app', 'Id Pesquisador'),
            'Nome' => Yii::t('app', 'Nome'),
            'email' => Yii::t('app', 'Email'),
            'lattes' => Yii::t('app', 'Lattes'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'senha' => Yii::t('app', 'Senha'),
            'foto' => Yii::t('app', 'Foto'),
            'Resumo' => Yii::t('app', 'Resumo'),
            'idCronTask' => Yii::t('app', 'Id Cron Task'),
            'isAdminBase' => Yii::t('app', 'Is Admin Base'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColetas()
    {
        return $this->hasMany(\app\models\Coleta::className(), ['idPesquisadorRegistro' => 'idPesquisador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColetaHasPesquisadores()
    {
        return $this->hasMany(\app\models\ColetaHasPesquisador::className(), ['idPesquisador' => 'idPesquisador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdColetas()
    {
        return $this->hasMany(\app\models\Coleta::className(), ['idColeta' => 'idColeta'])->viaTable('Coleta_has_Pesquisador', ['idPesquisador' => 'idPesquisador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuradorias()
    {
        return $this->hasMany(\app\models\Curadoria::className(), ['idPesquisador' => 'idPesquisador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoOrganismos()
    {
        return $this->hasMany(\app\models\TipoOrganismo::className(), ['idTipoOrganismo' => 'idTipoOrganismo'])->viaTable('Curadoria', ['idPesquisador' => 'idPesquisador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNaoIdentificados()
    {
        return $this->hasMany(\app\models\NaoIdentificado::className(), ['idPesquisadorIdentificacao' => 'idPesquisador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCronTask0()
    {
        return $this->hasOne(\app\models\CronTask::className(), ['idCronTask' => 'idCronTask']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesquisadorHasPermissoes()
    {
        return $this->hasMany(\app\models\PesquisadorHasPermissoes::className(), ['idPesquisador' => 'idPesquisador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesquisadorHasProjetos()
    {
        return $this->hasMany(\app\models\PesquisadorHasProjeto::className(), ['idPesquisador' => 'idPesquisador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProjetos()
    {
        return $this->hasMany(\app\models\Projeto::className(), ['idProjeto' => 'idProjeto'])->viaTable('Pesquisador_has_Projeto', ['idPesquisador' => 'idPesquisador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProjetos()
    {
        return $this->hasMany(\app\models\Projeto::className(), ['idPesquisadorResponsavel' => 'idPesquisador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadeGeograficas()
    {
        return $this->hasMany(\app\models\UnidadeGeografica::className(), ['idPesquisador' => 'idPesquisador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(\app\models\AuthAssignment::className(), ['user_id' => 'idPesquisador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(\app\models\AuthItem::className(), ['name' => 'item_name'])->viaTable('auth_assignment', ['user_id' => 'idPesquisador']);
    }
}
