<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "Permissoes".
 *
 * @property integer $idPermissoes
 * @property string $Nome
 *
 * @property PesquisadorHasPermissoes[] $pesquisadorHasPermissoes
 */
class Permissoes extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Permissoes';
    }
    
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->Nome;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Nome'], 'required'],
            [['Nome'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPermissoes' => Yii::t('app', 'Id Permissoes'),
            'Nome' => Yii::t('app', 'Nome'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPesquisadorHasPermissoes()
    {
        return $this->hasMany(\app\models\PesquisadorHasPermissoes::className(), ['idPermissoes' => 'idPermissoes']);
    }
}
