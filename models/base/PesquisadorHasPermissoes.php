<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "Pesquisador_has_Permissoes".
 *
 * @property integer $idPesquisador
 * @property integer $idPermissoes
 * @property integer $idProjeto
 * 
 * @property Pesquisador $idPesquisador0
 * @property Permissoes $idPermissoes0
 * @property Projeto $idProjeto0
 */
class PesquisadorHasPermissoes extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Pesquisador_has_Permissoes';
    }
    
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->idPermissoes;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPesquisador', 'idPermissoes', 'idProjeto'], 'required'],
            [['idPesquisador', 'idPermissoes', 'idProjeto'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPesquisador' => Yii::t('app', 'Id Pesquisador'),
            'idPermissoes' => Yii::t('app', 'Id Permissoes'),
            'idProjeto' => Yii::t('app', 'Id Projeto'),
        ];
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
    public function getIdPermissoes0()
    {
        return $this->hasOne(\app\models\Permissoes::className(), ['idPermissoes' => 'idPermissoes']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProjeto0()
    {
        return $this->hasOne(\app\models\Projeto::className(), ['idProjeto' => 'idProjeto']);
    }
}
