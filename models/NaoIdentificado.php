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
            'idTipoOrganismo' => Yii::t('app', 'Tipo Organismo'),
            'idEspecie' => Yii::t('app', 'Espécie'),
            'idPesquisadorIdentificacao' => Yii::t('app', 'Responsável pela identificação'),
            'Data_Registro' => Yii::t('app', 'Data de  Registro'),
            'Data_Identificacao' => Yii::t('app', 'Data de Identificação'),
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

}
