<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "Curadoria".
 *
 * @property integer $idTipoOrganismo
 * @property integer $idPesquisador
 *
 * @property Pesquisador $idPesquisador0
 * @property TipoOrganismo $idTipoOrganismo0
 */
class Curadoria extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Curadoria';
    }
    
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->idPesquisador;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idTipoOrganismo', 'idPesquisador'], 'required'],
            [['idTipoOrganismo', 'idPesquisador'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoOrganismo' => Yii::t('app', 'Id Tipo Organismo'),
            'idPesquisador' => Yii::t('app', 'Id Pesquisador'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPesquisador0()
    {
        return $this->hasOne(\app\models\Pesquisador::className(), ['idPesquisador' => 'idPesquisador']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdTipoOrganismo0()
    {
        return $this->hasOne(\app\models\TipoOrganismo::className(), ['idTipoOrganismo' => 'idTipoOrganismo']);
    }
}
