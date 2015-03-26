<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoAtributo;

/**
 * TipoAtributoSearch represents the model behind the search form about TipoAtributo.
 */
class TipoAtributoSearch extends Model
{
	public $idTipoAtributo;
	public $Tipo;
	public $Descricao;

	public function rules()
	{
		return [
			[['idTipoAtributo'], 'integer'],
			[['Tipo', 'Descricao'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'idTipoAtributo' => 'Identificador do Tipo de Atributo',
			'Tipo' => 'Tipo de Atributo',
			'Descricao' => 'Descrição',
		];
	}

	public function search($params)
	{
		$query = TipoAtributo::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'idTipoAtributo' => $this->idTipoAtributo,
        ]);

		$query->andFilterWhere(['like', 'Tipo', $this->Tipo])
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
