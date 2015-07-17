<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "Pesquisador_has_Projeto".
 *
 * @property integer $idPesquisador
 * @property integer $idProjeto
 *
 * @property Pesquisador $idPesquisador0
 * @property Projeto $idProjeto0
 */
class PesquisadorHasProjeto extends \app\models\MActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Pesquisador_has_Projeto';
    }

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->idProjeto;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idPesquisador', 'idProjeto'], 'required'],
            [['idPesquisador', 'idProjeto'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPesquisador' => Yii::t('app', 'Id Pesquisador'),
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
    public function getIdProjeto0()
    {
        return $this->hasOne(\app\models\Projeto::className(), ['idProjeto' => 'idProjeto']);
    }

}
