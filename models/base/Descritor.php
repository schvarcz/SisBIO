<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "Descritor".
 *
 * @property integer $idDescritor
 * @property string $Nome
 * @property integer $idTipoDado
 * @property integer $idTipoDescritor
 * @property string $Descricao
 *
 * @property ColetaItemPropriedade[] $coletaItemPropriedades
 * @property TipoDado $idTipoDado0
 * @property TipoDescritor $idTipoDescritor0
 * @property TipoOrganismoHasDescritor[] $tipoOrganismoHasDescritores
 * @property TipoOrganismo[] $idTipoOrganismos
 * @property UnidadeGeograficaHasDescritor[] $unidadeGeograficaHasDescritores
 * @property UnidadeGeografica[] $idUnidadeGeograficas
 */
class Descritor extends \app\models\MActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Descritor';
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
            [['Nome', 'idTipoDado', 'idTipoDescritor'], 'required'],
            [['idTipoDado', 'idTipoDescritor'], 'integer'],
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
            'idDescritor' => Yii::t('app', 'Id Descritor'),
            'Nome' => Yii::t('app', 'Nome'),
            'idTipoDado' => Yii::t('app', 'Id Tipo Dado'),
            'idTipoDescritor' => Yii::t('app', 'Id Tipo Descritor'),
            'Descricao' => Yii::t('app', 'Descricao'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColetaItemPropriedades()
    {
        return $this->hasMany(\app\models\ColetaItemPropriedade::className(), ['idDescritor' => 'idDescritor']);
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
    public function getIdTipoDescritor0()
    {
        return $this->hasOne(\app\models\TipoDescritor::className(), ['idTipoDescritor' => 'idTipoDescritor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoOrganismoHasDescritores()
    {
        return $this->hasMany(\app\models\TipoOrganismoHasDescritor::className(), ['idDescritor' => 'idDescritor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoOrganismos()
    {
        return $this->hasMany(\app\models\TipoOrganismo::className(), ['idTipoOrganismo' => 'idTipoOrganismo'])->viaTable('TipoOrganismo_has_Descritor', ['idDescritor' => 'idDescritor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUnidadeGeograficaHasDescritores()
    {
        return $this->hasMany(\app\models\UnidadeGeograficaHasDescritor::className(), ['idDescritor' => 'idDescritor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUnidadeGeograficas()
    {
        return $this->hasMany(\app\models\UnidadeGeografica::className(), ['idUnidadeGeografica' => 'idUnidadeGeografica'])->viaTable('UnidadeGeografica_has_Descritor', ['idDescritor' => 'idDescritor']);
    }

}
