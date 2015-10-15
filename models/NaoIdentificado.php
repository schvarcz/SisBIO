<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "NaoIdentificado".
 */
class NaoIdentificado extends \app\models\base\NaoIdentificado
{

    function getLabel()
    {
        return "NI" . $this->primaryKey . " - " . $this->idTipoOrganismo0->Nome;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idNaoIdentificado' => Yii::t('app', 'Id Não Identificado'),
            'idTipoOrganismo' => Yii::t('app', 'Tipo de Organismo'),
            'idPesquisadorIdentificacao' => Yii::t('app', 'Responsável pela identificação'),
            'Data_Registro' => Yii::t('app', 'Data de  Registro'),
            'Data_Identificacao' => Yii::t('app', 'Data de Identificação'),
            'MorfoEspecie' => Yii::t('app', 'Morfoespécie'),
            'idFilo' => Yii::t('app', 'Filo'),
            'idOrdem' => Yii::t('app', 'Ordem'),
            'idFamilia' => Yii::t('app', 'Família'),
            'idGenero' => Yii::t('app', 'Gênero'),
            'idEspecie' => Yii::t('app', 'Espécie'),
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($this->idEspecie != $changedAttributes["idEspecie"])
        {
            ColetaItem::updateAll(["idEspecie" => $this->idEspecie], ["idNaoIdentificado" => $this->primaryKey]);
        }
        return parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getColetas()
    {
        return $this->hasMany(\app\models\Coleta::className(), ['idColeta' => 'idColeta'])->viaTable('ColetaItem', ['idNaoIdentificado' => 'idNaoIdentificado']);
    }

}
