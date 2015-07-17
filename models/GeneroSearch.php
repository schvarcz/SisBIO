<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Genero;

/**
 * GeneroSearch represents the model behind the search form about Genero.
 */
class GeneroSearch extends Model
{

    public $idGenero;
    public $NomeCientifico;
    public $Descricao;
    public $idFamilia;

    public function rules()
    {
        return [
            [['idGenero', 'idFamilia'], 'integer'],
            [['NomeCientifico', 'Descricao'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idGenero' => 'Id Genero',
            'NomeCientifico' => 'Nome Cientifico',
            'Descricao' => 'Descricao',
            'idFamilia' => 'Id Familia',
        ];
    }

    public function search($params)
    {
        $query = Genero::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idGenero' => $this->idGenero,
            'idFamilia' => $this->idFamilia,
        ]);

        $query->andFilterWhere(['like', 'NomeCientifico', $this->NomeCientifico])
                ->andFilterWhere(['like', 'Descricao', $this->Descricao]);

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
