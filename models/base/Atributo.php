<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "Atributo".
 *
 * @property integer $idAtributo
 * @property string $Nome
 * @property integer $idTipoDado
 * @property integer $idTipoAtributo
 * @property string $Descricao
 *
 * @property TipoAtributo $idTipoAtributo0
 * @property TipoDado $idTipoDado0
 * @property TipoOrganismoHasAtributo[] $tipoOrganismoHasAtributos
 * @property TipoOrganismo[] $idTipoOrganismos
 */
class Atributo extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Atributo';
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
            [['Nome', 'idTipoDado', 'idTipoAtributo'], 'required'],
            [['idTipoDado', 'idTipoAtributo'], 'integer'],
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
            'idAtributo' => Yii::t('app', 'Id Atributo'),
            'Nome' => Yii::t('app', 'Nome'),
            'idTipoDado' => Yii::t('app', 'Id Tipo Dado'),
            'idTipoAtributo' => Yii::t('app', 'Id Tipo Atributo'),
            'Descricao' => Yii::t('app', 'Descricao'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoAtributo0()
    {
        return $this->hasOne(\app\models\TipoAtributo::className(), ['idTipoAtributo' => 'idTipoAtributo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoDado0()
    {
        return $this->hasOne(\app\models\TipoDado::className(), ['idTipoDado' => 'idTipoDado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoOrganismoHasAtributos()
    {
        return $this->hasMany(\app\models\TipoOrganismoHasAtributo::className(), ['idAtributo' => 'idAtributo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoOrganismos()
    {
        return $this->hasMany(\app\models\TipoOrganismo::className(), ['idTipoOrganismo' => 'idTipoOrganismo'])->viaTable('TipoOrganismo_has_Atributo', ['idAtributo' => 'idAtributo']);
    }
}
