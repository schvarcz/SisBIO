<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "Metodo".
 *
 * @property integer $idMetodo
 * @property string $Nome
 * @property string $Descricao
 *
 * @property Coleta[] $coletas
 * @property TipoOrganismoHasMetodo[] $tipoOrganismoHasMetodos
 * @property TipoOrganismo[] $idTipoOrganismos
 */
class Metodo extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Metodo';
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
            [['Descricao'], 'string'],
            [['Nome'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idMetodo' => Yii::t('app', 'Id Metodo'),
            'Nome' => Yii::t('app', 'Nome'),
            'Descricao' => Yii::t('app', 'Descricao'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColetas()
    {
        return $this->hasMany(\app\models\Coleta::className(), ['idMetodo' => 'idMetodo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoOrganismoHasMetodos()
    {
        return $this->hasMany(\app\models\TipoOrganismoHasMetodo::className(), ['idMetodo' => 'idMetodo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoOrganismos()
    {
        return $this->hasMany(\app\models\TipoOrganismo::className(), ['idTipoOrganismo' => 'idTipoOrganismo'])->viaTable('TipoOrganismo_has_Metodo', ['idMetodo' => 'idMetodo']);
    }
}
