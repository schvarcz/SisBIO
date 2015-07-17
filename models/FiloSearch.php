<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Filo;

/**
 * FiloSearch represents the model behind the search form about Filo.
 */
class FiloSearch extends Model
{

    public $idFilo;
    public $NomeCientifico;
    public $Descricao;

    public function rules()
    {
        return [
            [['idFilo'], 'integer'],
            [['NomeCientifico', 'Descricao'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idFilo' => 'Id Filo',
            'NomeCientifico' => 'Nome Cientifico',
            'Descricao' => 'Descricao',
        ];
    }

    public function search($params)
    {
        $query = Filo::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idFilo' => $this->idFilo,
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
