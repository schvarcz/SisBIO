<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Metodo;

/**
 * MetodoSearch represents the model behind the search form about Metodo.
 */
class MetodoSearch extends Model
{

    public $idMetodo;
    public $Nome;
    public $Descricao;

    public function rules()
    {
        return [
            [['idMetodo'], 'integer'],
            [['Nome', 'Descricao'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idMetodo' => 'Id Metodo',
            'Nome' => 'Nome',
            'Descricao' => 'Descricao',
        ];
    }

    public function search($params)
    {
        $query = Metodo::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idMetodo' => $this->idMetodo,
        ]);

        $query->andFilterWhere(['like', 'Nome', $this->Nome])
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
