<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\NaoIdentificado;

/**
 * NaoIdentificadoSearch represents the model behind the search form about NaoIdentificado.
 */
class NaoIdentificadoSearch extends Model
{
	public $idNaoIdentificado;
	public $idTipoOrganismo;
	public $idPesquisadorIdentificacao;
	public $Data_Registro;
	public $Data_Identificacao;
	public $MorfoEspecie;
	public $idFilo;
	public $idOrdem;
	public $idFamilia;
	public $idGenero;
	public $idEspecie;

	public function rules()
	{
		return [
			[['idNaoIdentificado', 'idTipoOrganismo', 'idPesquisadorIdentificacao', 'idFilo', 'idOrdem', 'idFamilia', 'idGenero', 'idEspecie'], 'integer'],
			[['Data_Registro', 'Data_Identificacao', 'MorfoEspecie'], 'safe'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'idNaoIdentificado' => 'Id Não Identificado',
			'idTipoOrganismo' => 'Tipo Organismo',
			'idPesquisadorIdentificacao' => 'Responsável pela identificação',
			'Data_Registro' => 'Data de  Registro',
			'Data_Identificacao' => 'Data de Identificação',
			'MorfoEspecie' => 'Morfo Especie',
			'idFilo' => 'Id Filo',
			'idOrdem' => 'Id Ordem',
			'idFamilia' => 'Id Familia',
			'idGenero' => 'Id Genero',
			'idEspecie' => 'Espécie',
		];
	}

	public function search($params)
	{
		$query = NaoIdentificado::find();
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
		]);

		if (!($this->load($params) && $this->validate())) {
			return $dataProvider;
		}

		$query->andFilterWhere([
            'idNaoIdentificado' => $this->idNaoIdentificado,
            'idTipoOrganismo' => $this->idTipoOrganismo,
            'idPesquisadorIdentificacao' => $this->idPesquisadorIdentificacao,
            'Data_Registro' => $this->Data_Registro,
            'Data_Identificacao' => $this->Data_Identificacao,
            'idFilo' => $this->idFilo,
            'idOrdem' => $this->idOrdem,
            'idFamilia' => $this->idFamilia,
            'idGenero' => $this->idGenero,
            'idEspecie' => $this->idEspecie,
        ]);

		$query->andFilterWhere(['like', 'MorfoEspecie', $this->MorfoEspecie]);

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
