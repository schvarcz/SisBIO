<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "TipoOrganismo".
 *
 * @property integer $idTipoOrganismo
 * @property string $Nome
 * @property string $Descricao
 *
 * @property Especie[] $especies
 * @property TipoOrganismoHasAtributo[] $tipoOrganismoHasAtributos
 * @property Atributo[] $idAtributos
 */
class TipoOrganismo extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'TipoOrganismo';
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
            'idTipoOrganismo' => Yii::t('app', 'Id Tipo Organismo'),
            'Nome' => Yii::t('app', 'Nome'),
            'Descricao' => Yii::t('app', 'Descricao'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEspecies()
    {
        return $this->hasMany(\app\models\Especie::className(), ['idTipo_Organismo' => 'idTipoOrganismo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoOrganismoHasAtributos()
    {
        return $this->hasMany(\app\models\TipoOrganismoHasAtributo::className(), ['idTipoOrganismo' => 'idTipoOrganismo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAtributos()
    {
        return $this->hasMany(\app\models\Atributo::className(), ['idAtributo' => 'idAtributo'])->viaTable('TipoOrganismo_has_Atributo', ['idTipoOrganismo' => 'idTipoOrganismo']);
    }
}
