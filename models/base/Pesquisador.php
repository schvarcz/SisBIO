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
 * @property string $login
 * @property string $senha
 * @property string $foto
 * @property string $Resumo
 *
 * @property ColetaHasPesquisador[] $coletaHasPesquisadors
 * @property Coleta[] $idColetas
 * @property PesquisadorHasProjeto[] $pesquisadorHasProjetos
 * @property Projeto[] $idProjetos
 * @property Projeto[] $projetos
 * @property UnidadeGeografica[] $unidadeGeograficas
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
            [['Nome', 'email', 'lattes', 'senha', 'foto'], 'string', 'max' => 255],
            [['login'], 'string', 'max' => 45],
            [['lattes'], 'unique']
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
            'login' => Yii::t('app', 'Login'),
            'senha' => Yii::t('app', 'Senha'),
            'foto' => Yii::t('app', 'Foto'),
            'Resumo' => Yii::t('app', 'Resumo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColetaHasPesquisadors()
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
}