<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "Coleta".
 *
 * @property integer $idColeta
 * @property string $Data_Coleta
 * @property string $Observacao
 * @property integer $idUnidadeGeografica
 * @property string $coordenadaGeografica
 *
 * @property UnidadeGeografica $idUnidadeGeografica0
 * @property ColetaItem[] $coletaItems
 * @property ColetaHasPesquisador[] $coletaHasPesquisadors
 * @property Pesquisador[] $idPesquisadors
 */
class Coleta extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Coleta';
    }
    
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->Data_Coleta;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Data_Coleta', 'idUnidadeGeografica'], 'required'],
            [['Data_Coleta'], 'safe'],
            [['Observacao', 'coordenadaGeografica'], 'string'],
            [['idUnidadeGeografica'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idColeta' => Yii::t('app', 'Id Coleta'),
            'Data_Coleta' => Yii::t('app', 'Data  Coleta'),
            'Observacao' => Yii::t('app', 'Observacao'),
            'idUnidadeGeografica' => Yii::t('app', 'Id Unidade Geografica'),
            'coordenadaGeografica' => Yii::t('app', 'Coordenada Geografica'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUnidadeGeografica0()
    {
        return $this->hasOne(\app\models\UnidadeGeografica::className(), ['idUnidadeGeografica' => 'idUnidadeGeografica']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColetaItems()
    {
        return $this->hasMany(\app\models\ColetaItem::className(), ['idColeta' => 'idColeta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColetaHasPesquisadors()
    {
        return $this->hasMany(\app\models\ColetaHasPesquisador::className(), ['idColeta' => 'idColeta']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPesquisadors()
    {
        return $this->hasMany(\app\models\Pesquisador::className(), ['idPesquisador' => 'idPesquisador'])->viaTable('Coleta_has_Pesquisador', ['idColeta' => 'idColeta']);
    }
}
