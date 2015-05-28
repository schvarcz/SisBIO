<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "NaoIdentificado".
 *
 * @property integer $idNaoIdentificado
 * @property integer $idTipoOrganismo
 * @property integer $idEspecie
 * @property integer $idPesquisadorIdentificacao
 * @property string $Data_Registro
 * @property string $Data_Identificacao
 *
 * @property ColetaItem[] $coletaItems
 * @property Especie $idEspecie0
 * @property Pesquisador $idPesquisadorIdentificacao0
 * @property TipoOrganismo $idTipoOrganismo0
 */
class NaoIdentificado extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'NaoIdentificado';
    }
    
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->idTipoOrganismo;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTipoOrganismo'], 'required'],
            [['idTipoOrganismo', 'idEspecie', 'idPesquisadorIdentificacao'], 'integer'],
            [['Data_Registro', 'Data_Identificacao'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idNaoIdentificado' => Yii::t('app', 'Id Nao Identificado'),
            'idTipoOrganismo' => Yii::t('app', 'Id Tipo Organismo'),
            'idEspecie' => Yii::t('app', 'Id Especie'),
            'idPesquisadorIdentificacao' => Yii::t('app', 'Id Pesquisador Identificacao'),
            'Data_Registro' => Yii::t('app', 'Data  Registro'),
            'Data_Identificacao' => Yii::t('app', 'Data  Identificacao'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColetaItems()
    {
        return $this->hasMany(\app\models\ColetaItem::className(), ['idNaoIdentificado' => 'idNaoIdentificado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEspecie0()
    {
        return $this->hasOne(\app\models\Especie::className(), ['idEspecie' => 'idEspecie']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPesquisadorIdentificacao0()
    {
        return $this->hasOne(\app\models\Pesquisador::className(), ['idPesquisador' => 'idPesquisadorIdentificacao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoOrganismo0()
    {
        return $this->hasOne(\app\models\TipoOrganismo::className(), ['idTipoOrganismo' => 'idTipoOrganismo']);
    }
}
