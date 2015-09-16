<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Familia;

/**
 * FamiliaSearch represents the model behind the search form about Familia.
 */
class FamiliaSearch extends Model
{

    public $idFamilia;
    public $NomeCientifico;
    public $Descricao;
    public $idOrdem;

    public function rules()
    {
        return [
            [['idFamilia'], 'integer'],
            [['NomeCientifico', 'Descricao', 'idOrdem'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idFamilia' => 'Id Familia',
            'NomeCientifico' => 'Nome Cientifico',
            'Descricao' => 'Descricao',
            'idOrdem' => 'Id Ordem',
        ];
    }

    public function search($params)
    {
        $query = Familia::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idFamilia' => $this->idFamilia,
        ]);
        
        if(trim($this->idOrdem))
            $query->joinWith("idOrdem0", true, "INNER JOIN")->andFilterWhere(['like', 'Ordem.NomeCientifico', $this->idOrdem]);

        $query->andFilterWhere(['like', 'Familia.NomeCientifico', $this->NomeCientifico])
                ->andFilterWhere(['like', 'Familia.Descricao', $this->Descricao]);

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
