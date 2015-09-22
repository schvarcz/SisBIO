<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "viewpesquisadorpermissoes".
 * 
 * 
 * @property Pesquisador $idPesquisador0
 * @property Projeto $idProjeto0
 */
class Viewpesquisadorpermissoes extends \app\models\base\Viewpesquisadorpermissoes
{

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
    public function getIdProjeto0()
    {
        return $this->hasOne(\app\models\Projeto::className(), ['idProjeto' => 'idProjeto']);
    }
}
