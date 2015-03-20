<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "Ordem".
 *
 * @property integer $idOrdem
 * @property string $NomeCientifico
 * @property string $NomeComum
 * @property string $Descricao
 * @property integer $idFilo
 *
 * @property Familia[] $familias
 * @property Filo $idFilo0
 */
class Ordem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ordem';
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
            [['NomeCientifico', 'idFilo'], 'required'],
            [['Descricao'], 'string'],
            [['idFilo'], 'integer'],
            [['NomeCientifico', 'NomeComum'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idOrdem' => Yii::t('app', 'Id Ordem'),
            'NomeCientifico' => Yii::t('app', 'Nome Cientifico'),
            'NomeComum' => Yii::t('app', 'Nome Comum'),
            'Descricao' => Yii::t('app', 'Descricao'),
            'idFilo' => Yii::t('app', 'Id Filo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFamilias()
    {
        return $this->hasMany(\app\models\Familia::className(), ['idOrdem' => 'idOrdem']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdFilo0()
    {
        return $this->hasOne(\app\models\Filo::className(), ['idFilo' => 'idFilo']);
    }
}
