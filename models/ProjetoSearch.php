<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Projeto;

/**
 * ProjetoSearch represents the model behind the search form about Projeto.
 */
class ProjetoSearch extends Model
{
	public $idProjeto;
	public $Nome;
	public $Data_Inicio;
	public $Data_Fim;
	public $ativo;
	public $idPesquisadorResponsavel;
	public $Descricao;

	public function rules()
	{
		return [
			[['idProjeto', 'ativo', 'idPesquisadorResponsavel'], 'integer'],
			[['Nome', 'Data_Inicio', 'Data_Fim', 'Descricao'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'idProjeto' => 'Id Projeto',
			'Nome' => 'Nome',
			'Data_Inicio' => 'Data  Inicio',
			'Data_Fim' => 'Data  Fim',
			'ativo' => 'Ativo',
			'idPesquisadorResponsavel' => 'Id Pesquisador Responsavel',
			'Descricao' => 'Descricao',
		];
	}

	public function search($params)
	{
		$query = Projeto::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'idProjeto' => $this->idProjeto,
            'Data_Inicio' => $this->Data_Inicio,
            'Data_Fim' => $this->Data_Fim,
            'ativo' => $this->ativo,
            'idPesquisadorResponsavel' => $this->idPesquisadorResponsavel,
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
