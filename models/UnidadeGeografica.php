<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "UnidadeGeografica".
 */
class UnidadeGeografica extends \app\models\base\UnidadeGeografica
{

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUnidadeGeografica' => Yii::t('app', 'Identificador da Unidade Geográfica'),
            'Nome' => Yii::t('app', 'Nome'),
            'shape' => Yii::t('app', 'Mapa'),
            'Data_Criacao' => Yii::t('app', 'Data de Criação'),
            'idProjeto' => Yii::t('app', 'Projeto'),
            'idPesquisador' => Yii::t('app', 'Pesquisador'),
            'idUnidadeGeograficaPai' => Yii::t('app', 'Unidade Geográfica Pai'),
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            $this->shape = new \yii\db\Expression("geomFromText('" . $this->shape . "')");
            return true;
        } else
            return false;
    }

    public function afterSave()
    {
        
    }

    public static function find()
    {

        $model = new UnidadeGeografica;
        $toSelect = [];
        $change = ["shape"];
        foreach ($model->getAttributes() as $key => $value)
        {
            if (in_array($key, $change))
                $toSelect[] = "AsText(" . $key . ") as " . $key;
            else
                $toSelect[] = $key;
        }
        $query = parent::find()->select($toSelect);
        return $query;
    }

    function getShapeAsArray()
    {
        $pts = explode(",", substr($this->shape, strripos($this->shape, "(") + 1, -2));
        $ret = [];
        foreach ($pts as $pt)
        {
            $pt = explode(" ", $pt);
            $pt[0] = (float) $pt[0];
            $pt[1] = (float) $pt[1];
            $ret[] = $pt;
        }
        return $ret;
    }

    function getShapeCenter()
    {
        $pts = $this->getShapeAsArray();
        $center = [0, 0];
        foreach ($pts as $pt)
        {
            $center[0] += $pt[0];
            $center[1] += $pt[1];
        }

        $len = count($pts);
        $center[0] /= $len;
        $center[1] /= $len;

        return $center;
    }

    function getShapeGeometry()
    {
        return substr($this->shape, 0, strpos($this->shape, "("));
    }

}
