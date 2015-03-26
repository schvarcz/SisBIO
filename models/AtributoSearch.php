<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Atributo;

/**
 * AtributoSearch represents the model behind the search form about Atributo.
 */
class AtributoSearch extends Model
{
	public $idAtributo;
	public $Nome;
	public $idTipoDado;
	public $idTipoAtributo;
	public $Descricao;

	public function rules()
	{
		return [
			[['idAtributo', 'idTipoDado', 'idTipoAtributo'], 'integer'],
			[['Nome', 'Descricao'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'idAtributo' => 'Id Atributo',
			'Nome' => 'Nome',
			'idTipoDado' => 'Id Tipo Dado',
			'idTipoAtributo' => 'Id Tipo de Atributo',
			'Descricao' => 'Descricao',
		];
	}

	public function search($params)
	{
		$query = Atributo::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'idAtributo' => $this->idAtributo,
            'idTipoDado' => $this->idTipoDado,
            'idTipoAtributo' => $this->idTipoAtributo,
        ]);

		$query->andFilterWhere(['like', 'Nome', $this->Nome])
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
