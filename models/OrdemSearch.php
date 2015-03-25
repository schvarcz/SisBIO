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
	public $NomeComum;
	public $Descricao;
	public $idFilo;

	public function rules()
	{
		return [
			[['idOrdem', 'idFilo'], 'integer'],
			[['NomeCientifico', 'NomeComum', 'Descricao'], 'safe'],
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
			'NomeComum' => 'Nome Comum',
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

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'idOrdem' => $this->idOrdem,
            'idFilo' => $this->idFilo,
        ]);

		$query->andFilterWhere(['like', 'NomeCientifico', $this->NomeCientifico])
            ->andFilterWhere(['like', 'NomeComum', $this->NomeComum])
            ->andFilterWhere(['like', 'Descricao', $this->Descricao]);

		return $dataProvider;
	}

	protected function addCondition($query, $attribute, $partialMatch = false)
	{
		$value = $this->$attribute;
		if (trim($value) === '') {
			return;
		}
		if ($partialMatch) {
			$value = '%' . strtr($value, ['%'=>'\%', '_'=>'\_', '\\'=>'\\\\']) . '%';
			$query->andWhere(['like', $attribute, $value]);
		} else {
			$query->andWhere([$attribute => $value]);
		}
	}
}
