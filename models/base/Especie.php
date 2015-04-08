<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "Especie".
 *
 * @property integer $idEspecie
 * @property string $NomeCientifico
 * @property string $NomeComum
 * @property string $Autor
 * @property string $Descricao
 * @property integer $idGenero
 * @property integer $idTipo_Organismo
 *
 * @property ColetaItem[] $coletaItems
 * @property Genero $idGenero0
 * @property TipoOrganismo $idTipoOrganismo
 */
class Especie extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Especie';
    }
    
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->NomeCientifico;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NomeCientifico', 'idGenero', 'idTipo_Organismo'], 'required'],
            [['Descricao'], 'string'],
            [['idGenero', 'idTipo_Organismo'], 'integer'],
            [['NomeCientifico', 'NomeComum', 'Autor'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idEspecie' => Yii::t('app', 'Id Especie'),
            'NomeCientifico' => Yii::t('app', 'Nome Cientifico'),
            'NomeComum' => Yii::t('app', 'Nome Comum'),
            'Autor' => Yii::t('app', 'Autor'),
            'Descricao' => Yii::t('app', 'Descricao'),
            'idGenero' => Yii::t('app', 'Id Genero'),
            'idTipo_Organismo' => Yii::t('app', 'Id Tipo  Organismo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColetaItems()
    {
        return $this->hasMany(\app\models\ColetaItem::className(), ['idEspecie' => 'idEspecie']);
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
    public function getIdTipoOrganismo()
    {
        return $this->hasOne(\app\models\TipoOrganismo::className(), ['idTipoOrganismo' => 'idTipo_Organismo']);
    }
}
