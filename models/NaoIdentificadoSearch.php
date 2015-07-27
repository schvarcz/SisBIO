<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NaoIdentificado;

/**
 * NaoIdentificadoSearch represents the model behind the search form about NaoIdentificado.
 */
class NaoIdentificadoSearch extends Model
{

    public $idNaoIdentificado;
    public $idTipoOrganismo;
    public $idEspecie;
    public $idPesquisadorIdentificacao;
    public $Data_Registro;
    public $Data_Identificacao;

    public function rules()
    {
        return [
            [['idNaoIdentificado', 'idTipoOrganismo', 'idEspecie', 'idPesquisadorIdentificacao'], 'integer'],
            [['Data_Registro', 'Data_Identificacao'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idNaoIdentificado' => 'Id Nao Identificado',
            'idTipoOrganismo' => 'Id Tipo Organismo',
            'idEspecie' => 'Id Especie',
            'idPesquisadorIdentificacao' => 'Id Pesquisador Identificacao',
            'Data_Registro' => 'Data  Registro',
            'Data_Identificacao' => 'Data  Identificacao',
        ];
    }

    public function search($params)
    {
        $query = NaoIdentificado::find();
        $query->where(["idEspecie" => NULL]);
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idNaoIdentificado' => $this->idNaoIdentificado,
            'idTipoOrganismo' => $this->idTipoOrganismo,
            'idPesquisadorIdentificacao' => $this->idPesquisadorIdentificacao,
            'Data_Registro' => $this->Data_Registro,
            'Data_Identificacao' => $this->Data_Identificacao,
        ]);

        return $dataProvider;
    }

    protected function addCondition($query, $attribute, $partialMatch = false)
    {
        $value = $this->$attribute;
        if (trim($value) === '')
        {
            return;
        }
        if ($partialMatch)
        {
            $value = '%' . strtr($value, ['%' => '\%', '_' => '\_', '\\' => '\\\\']) . '%';
            $query->andWhere(['like', $attribute, $value]);
        } else
        {
            $query->andWhere([$attribute => $value]);
        }
    }

}
