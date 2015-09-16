<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UnidadeGeografica;

/**
 * UnidadeGeograficaSearch represents the model behind the search form about UnidadeGeografica.
 */
class UnidadeGeograficaSearch extends Model
{

    public $idUnidadeGeografica;
    public $Nome;
    public $shape;
    public $Data_Criacao;
    public $idProjeto;
    public $idPesquisador;

    public function rules()
    {
        return [
            [['idUnidadeGeografica'], 'integer'],
            [['Nome', 'shape', 'Data_Criacao', 'idProjeto', 'idPesquisador'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUnidadeGeografica' => 'Id Unidade Geografica',
            'Nome' => 'Nome',
            'shape' => 'Shape',
            'Data_Criacao' => 'Data  Criacao',
            'idProjeto' => 'Id Projeto',
            'idPesquisador' => 'Id Pesquisador',
            'idUnidadeGeograficaPai' => 'Id Unidade Geografica Pai',
        ];
    }

    public function search($params)
    {
        $query = UnidadeGeografica::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idUnidadeGeografica' => $this->idUnidadeGeografica,
            'Data_Criacao' => $this->Data_Criacao,
        ]);
        
        if(trim($this->idProjeto))
            $query->joinWith("idProjeto0", true, "INNER JOIN")->andFilterWhere(['like', 'Projeto.Nome', $this->idProjeto]);
        if(trim($this->idPesquisador))
            $query->joinWith("idPesquisador0", true, "INNER JOIN")->andFilterWhere(['like', 'Pesquisador.Nome', $this->idPesquisador]);

        $query->andFilterWhere(['like', 'UnidadeGeografica.Nome', $this->Nome])
                ->andFilterWhere(['like', 'shape', $this->shape]);

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
