<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Especie;

/**
 * EspecieSearch represents the model behind the search form about Especie.
 */
class EspecieSearch extends Model
{

    public $idEspecie;
    public $NomeCientifico;
    public $NomeComum;
    public $Autor;
    public $Descricao;
    public $idGenero;
    public $idTipo_Organismo;

    public function rules()
    {
        return [
            [['idEspecie'], 'integer'],
            [['NomeCientifico', 'NomeComum', 'Autor', 'Descricao', 'idGenero', 'idTipo_Organismo'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idEspecie' => 'Identificador da Espécie',
            'NomeCientifico' => 'Nome Científico',
            'NomeComum' => 'Nome Comum',
            'Autor' => 'Autor',
            'Descricao' => 'Descrição',
            'idGenero' => 'Gênero',
            'idTipo_Organismo' => 'Tipo de Organismo',
        ];
    }

    public function search($params)
    {
        $query = Especie::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idEspecie' => $this->idEspecie,
        ]);
        if(trim($this->idGenero))
            $query->joinWith("idGenero0", true, "INNER JOIN")->andFilterWhere(['like', 'Genero.NomeCientifico', $this->idGenero]);
        if(trim($this->idTipo_Organismo))
            $query->joinWith("idTipoOrganismo", true, "INNER JOIN")->andFilterWhere(['like', 'TipoOrganismo.Nome', $this->idTipo_Organismo]);

        $query->andFilterWhere(['like', 'Especie.NomeCientifico', $this->NomeCientifico])
                ->andFilterWhere(['like', 'NomeComum', $this->NomeComum])
                ->andFilterWhere(['like', 'Autor', $this->Autor])
                ->andFilterWhere(['like', 'Especie.Descricao', $this->Descricao]);

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
