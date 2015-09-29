<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "NaoIdentificado".
 *
 * @property integer $idNaoIdentificado
 * @property integer $idTipoOrganismo
 * @property integer $idPesquisadorIdentificacao
 * @property string $Data_Registro
 * @property string $Data_Identificacao
 * @property string $MorfoEspecie
 * @property integer $idFilo
 * @property integer $idOrdem
 * @property integer $idFamilia
 * @property integer $idGenero
 * @property integer $idEspecie
 *
 * @property ColetaItem[] $coletaItems
 * @property Familia $idFamilia0
 * @property Filo $idFilo0
 * @property Genero $idGenero0
 * @property Ordem $idOrdem0
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
            [['idTipoOrganismo', 'idPesquisadorIdentificacao', 'idFilo', 'idOrdem', 'idFamilia', 'idGenero', 'idEspecie'], 'integer'],
            [['Data_Registro', 'Data_Identificacao'], 'safe'],
            [['MorfoEspecie'], 'string', 'max' => 255]
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
            'idPesquisadorIdentificacao' => Yii::t('app', 'Id Pesquisador Identificacao'),
            'Data_Registro' => Yii::t('app', 'Data  Registro'),
            'Data_Identificacao' => Yii::t('app', 'Data  Identificacao'),
            'MorfoEspecie' => Yii::t('app', 'Morfo Especie'),
            'idFilo' => Yii::t('app', 'Id Filo'),
            'idOrdem' => Yii::t('app', 'Id Ordem'),
            'idFamilia' => Yii::t('app', 'Id Familia'),
            'idGenero' => Yii::t('app', 'Id Genero'),
            'idEspecie' => Yii::t('app', 'Id Especie'),
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
    public function getIdFamilia0()
    {
        return $this->hasOne(\app\models\Familia::className(), ['idFamilia' => 'idFamilia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFilo0()
    {
        return $this->hasOne(\app\models\Filo::className(), ['idFilo' => 'idFilo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGenero0()
    {
        return $this->hasOne(\app\models\Genero::className(), ['idGenero' => 'idGenero']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdOrdem0()
    {
        return $this->hasOne(\app\models\Ordem::className(), ['idOrdem' => 'idOrdem']);
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
