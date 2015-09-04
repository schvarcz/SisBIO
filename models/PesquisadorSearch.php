<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Pesquisador;

/**
 * PesquisadorSearch represents the model behind the search form about Pesquisador.
 */
class PesquisadorSearch extends Model
{

    public $idPesquisador;
    public $Nome;
    public $email;
    public $lattes;
    public $Resumo;

    public function rules()
    {
        return [
            [['idPesquisador'], 'integer'],
            [['Nome', 'email', 'lattes', 'Resumo'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPesquisador' => 'Id Pesquisador',
            'Nome' => 'Nome',
            'email' => 'Email',
            'lattes' => 'Lattes',
            'Resumo' => 'Resumo',
        ];
    }

    public function search($params)
    {
        $query = Pesquisador::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idPesquisador' => $this->idPesquisador,
        ]);

        $query->andFilterWhere(['like', 'Nome', $this->Nome])
                ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'lattes', $this->lattes])
                ->andFilterWhere(['like', 'Resumo', $this->Resumo]);

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
