<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ColetaItemPropriedade".
 */
class ColetaItemPropriedade extends \app\models\base\ColetaItemPropriedade
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idColetaItemPropriedade' => Yii::t('app', 'Id Coleta Item Propriedade'),
            'idColetaItem' => Yii::t('app', 'Item da Coleta'),
            'idTipoOrganismo' => Yii::t('app', 'Tipo de Organismo'),
            'idAtributo' => Yii::t('app', 'Atributo'),
            'value' => Yii::t('app', 'Valor'),
            'impossivelColetar' => Yii::t('app', 'Impossível Coletar'),
        ];
    }
    
    public function load($data, $formName = null)
    {
        $flag = parent::load($data, $formName);
        if (empty($this->value))
        {
            $this->impossivelColetar = true;
//            print_r($this->attributes);
//            print_r($this->save());
//            exit();
        }
        return $flag;
    }
}
