<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "Familia".
 *
 * @property integer $idFamilia
 * @property string $NomeCientifico
 * @property string $NomeComum
 * @property string $Descricao
 * @property integer $idOrdem
 *
 * @property Ordem $idOrdem0
 * @property Genero[] $generos
 */
class Familia extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Familia';
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
            [['NomeCientifico', 'idOrdem'], 'required'],
            [['Descricao'], 'string'],
            [['idOrdem'], 'integer'],
            [['NomeCientifico', 'NomeComum'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idFamilia' => Yii::t('app', 'Id Familia'),
            'NomeCientifico' => Yii::t('app', 'Nome Cientifico'),
            'NomeComum' => Yii::t('app', 'Nome Comum'),
            'Descricao' => Yii::t('app', 'Descricao'),
            'idOrdem' => Yii::t('app', 'Id Ordem'),
        ];
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
    public function getGeneros()
    {
        return $this->hasMany(\app\models\Genero::className(), ['idFamilia' => 'idFamilia']);
    }
}
