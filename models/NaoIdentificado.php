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
        return "NI".$this->primaryKey." - ".$this->idTipoOrganismo0->Nome;
    }
}
