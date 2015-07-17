<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "Genero".
 *
 * @property integer $idGenero
 * @property string $NomeCientifico
 * @property string $Descricao
 * @property integer $idFamilia
 *
 * @property Especie[] $especies
 * @property Familia $idFamilia0
 */
class Genero extends \app\models\MActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Genero';
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
            [['NomeCientifico', 'idFamilia'], 'required'],
            [['Descricao'], 'string'],
            [['idFamilia'], 'integer'],
            [['NomeCientifico'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idGenero' => Yii::t('app', 'Id Genero'),
            'NomeCientifico' => Yii::t('app', 'Nome Cientifico'),
            'Descricao' => Yii::t('app', 'Descricao'),
            'idFamilia' => Yii::t('app', 'Id Familia'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspecies()
    {
        return $this->hasMany(\app\models\Especie::className(), ['idGenero' => 'idGenero']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFamilia0()
    {
        return $this->hasOne(\app\models\Familia::className(), ['idFamilia' => 'idFamilia']);
    }

}
