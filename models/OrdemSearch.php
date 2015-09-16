<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ordem;

/**
 * OrdemSearch represents the model behind the search form about Ordem.
 */
class OrdemSearch extends Model
{

    public $idOrdem;
    public $NomeCientifico;
    public $Descricao;
    public $idFilo;

    public function rules()
    {
        return [
            [['idOrdem'], 'integer'],
            [['NomeCientifico', 'Descricao', 'idFilo'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idOrdem' => 'Id Ordem',
            'NomeCientifico' => 'Nome Cientifico',
            'Descricao' => 'Descricao',
            'idFilo' => 'Id Filo',
        ];
    }

    public function search($params)
    {
        $query = Ordem::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idOrdem' => $this->idOrdem,
        ]);
        
        if(trim($this->idFilo))
            $query->joinWith("idFilo0", true, "INNER JOIN")->andFilterWhere(['like', 'Filo.NomeCientifico', $this->idFilo]);

        $query->andFilterWhere(['like', 'Ordem.NomeCientifico', $this->NomeCientifico])
                ->andFilterWhere(['like', 'Ordem.Descricao', $this->Descricao]);

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
