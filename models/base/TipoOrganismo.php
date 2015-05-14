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
 * @property TipoOrganismoHasDescritor[] $tipoOrganismoHasDescritores
 * @property Descritor[] $idDescritores
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
    public function getTipoOrganismoHasDescritores()
    {
        return $this->hasMany(\app\models\TipoOrganismoHasDescritor::className(), ['idTipoOrganismo' => 'idTipoOrganismo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDescritores()
    {
        return $this->hasMany(\app\models\Descritor::className(), ['idDescritor' => 'idDescritor'])->viaTable('TipoOrganismo_has_Descritor', ['idTipoOrganismo' => 'idTipoOrganismo']);
    }
}
