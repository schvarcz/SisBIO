<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "UnidadeGeografica".
 *
 * @property integer $idUnidadeGeografica
 * @property string $Nome
 * @property string $shape
 * @property string $Data_Criacao
 * @property integer $idProjeto
 * @property integer $idPesquisador
 * @property integer $idUnidadeGeograficaPai
 *
 * @property Coleta[] $coletas
 * @property ColetaItem[] $coletaItems
 * @property Pesquisador $idPesquisador0
 * @property Projeto $idProjeto0
 * @property UnidadeGeografica $idUnidadeGeograficaPai0
 * @property UnidadeGeografica[] $unidadeGeograficas
 * @property UnidadeGeograficaHasDescritor[] $unidadeGeograficaHasDescritores
 * @property Descritor[] $idDescritores
 */
class UnidadeGeografica extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'UnidadeGeografica';
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
            [['Nome', 'shape', 'idProjeto', 'idPesquisador'], 'required'],
            [['shape'], 'string'],
            [['Data_Criacao'], 'safe'],
            [['idProjeto', 'idPesquisador', 'idUnidadeGeograficaPai'], 'integer'],
            [['Nome'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUnidadeGeografica' => Yii::t('app', 'Id Unidade Geografica'),
            'Nome' => Yii::t('app', 'Nome'),
            'shape' => Yii::t('app', 'Shape'),
            'Data_Criacao' => Yii::t('app', 'Data  Criacao'),
            'idProjeto' => Yii::t('app', 'Id Projeto'),
            'idPesquisador' => Yii::t('app', 'Id Pesquisador'),
            'idUnidadeGeograficaPai' => Yii::t('app', 'Id Unidade Geografica Pai'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColetas()
    {
        return $this->hasMany(\app\models\Coleta::className(), ['idUnidadeGeografica' => 'idUnidadeGeografica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColetaItems()
    {
        return $this->hasMany(\app\models\ColetaItem::className(), ['idUnidadeGeografica' => 'idUnidadeGeografica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPesquisador0()
    {
        return $this->hasOne(\app\models\Pesquisador::className(), ['idPesquisador' => 'idPesquisador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProjeto0()
    {
        return $this->hasOne(\app\models\Projeto::className(), ['idProjeto' => 'idProjeto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUnidadeGeograficaPai0()
    {
        return $this->hasOne(\app\models\UnidadeGeografica::className(), ['idUnidadeGeografica' => 'idUnidadeGeograficaPai']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadeGeograficas()
    {
        return $this->hasMany(\app\models\UnidadeGeografica::className(), ['idUnidadeGeograficaPai' => 'idUnidadeGeografica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadeGeograficaHasDescritores()
    {
        return $this->hasMany(\app\models\UnidadeGeograficaHasDescritor::className(), ['idUnidadeGeografica' => 'idUnidadeGeografica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDescritores()
    {
        return $this->hasMany(\app\models\Descritor::className(), ['idDescritor' => 'idDescritor'])->viaTable('UnidadeGeografica_has_Descritor', ['idUnidadeGeografica' => 'idUnidadeGeografica']);
    }
}
