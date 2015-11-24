<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ColetaItem".
 * 
 * @property TipoOrganismo $idTipoOrganismo
 */
class ColetaItem extends \app\models\base\ColetaItem
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {   
        return [
            'idColetaItem' => Yii::t('app', 'Identificador do Item da Coleta'),
            'idColeta' => Yii::t('app', 'Coleta'),
            'idEspecie' => Yii::t('app', 'Espécie'),
        ];
    }
    
    public function getIdTipoOrganismo()
    {
        return $this->idEspecie0?
                $this->idEspecie0->idTipoOrganismo:
                    ($this->idNaoIdentificado0?
                        $this->idNaoIdentificado0->idTipoOrganismo0:NULL);
    }

}
