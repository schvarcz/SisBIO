<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "Coleta_has_Pesquisador".
 *
 * @property integer $idColeta
 * @property integer $idPesquisador
 *
 * @property Coleta $idColeta0
 * @property Pesquisador $idPesquisador0
 */
class ColetaHasPesquisador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Coleta_has_Pesquisador';
    }
    
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->idPesquisador;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idColeta', 'idPesquisador'], 'required'],
            [['idColeta', 'idPesquisador'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idColeta' => Yii::t('app', 'Id Coleta'),
            'idPesquisador' => Yii::t('app', 'Id Pesquisador'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdColeta0()
    {
        return $this->hasOne(\app\models\Coleta::className(), ['idColeta' => 'idColeta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPesquisador0()
    {
        return $this->hasOne(\app\models\Pesquisador::className(), ['idPesquisador' => 'idPesquisador']);
    }
}
