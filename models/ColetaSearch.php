<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Coleta;

/**
 * ColetaSearch represents the model behind the search form about Coleta.
 */
class ColetaSearch extends Model
{
	public $idColeta;
	public $Data_Coleta;
	public $Observacao;
	public $idUnidadeGeografica;
	public $coordenadaGeografica;

	public function rules()
	{
		return [
			[['idColeta', 'idUnidadeGeografica'], 'integer'],
			[['Data_Coleta', 'Observacao', 'coordenadaGeografica'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'idColeta' => 'Id Coleta',
			'Data_Coleta' => 'Data  Coleta',
			'Observacao' => 'Observacao',
			'idUnidadeGeografica' => 'Id Unidade Geografica',
			'coordenadaGeografica' => 'Coordenada Geografica',
		];
	}

	public function search($params)
	{
		$query = Coleta::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'idColeta' => $this->idColeta,
            'Data_Coleta' => $this->Data_Coleta,
            'idUnidadeGeografica' => $this->idUnidadeGeografica,
        ]);

		$query->andFilterWhere(['like', 'Observacao', $this->Observacao])
            ->andFilterWhere(['like', 'coordenadaGeografica', $this->coordenadaGeografica]);

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
