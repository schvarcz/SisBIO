<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Exportacao;

/**
 * ExportacaoSearch represents the model behind the search form about Exportacao.
 */
class ExportacaoSearch extends Model
{

    public $idProjeto;
    public $idUnidadeGeografica;
    public $includeChildren;
    public $dataInicio;
    public $dataFim;

    public function rules()
    {
        return [
            [['idProjeto', 'idUnidadeGeografica', 'includeChildren'], 'integer'],
            [['dataInicio', 'dataFim'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idProjeto' => 'Projeto',
            'idUnidadeGeografica' => 'Unidade Geográfica',
            'includeChildren' => 'Include Children',
            'dataInicio' => 'Data de Incio',
            'dataFim' => 'Data de Fim',
        ];
    }

    public function search($params)
    {
        $query = Coleta::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idProjeto' => $this->idProjeto,
            'idUnidadeGeografica' => $this->idUnidadeGeografica,
        ]);
        
        if (!(empty($this->dataInicio) || empty($this->dataFim)))
        {
            $query->andFilterWhere(['between', 'Data_Coleta',
                \DateTime::createFromFormat("d/m/Y", $this->dataInicio)->format("Y-m-d H:i"),
                \DateTime::createFromFormat("d/m/Y", $this->dataFim)->format("Y-m-d H:i")]);
        }
        if (!empty($this->dataInicio))
        {
            $query->andFilterWhere(['>', 'Data_Coleta',
                \DateTime::createFromFormat("d/m/Y", $this->dataInicio)->format("Y-m-d H:i")]);
        }
        if (!empty($this->dataFim))
        {
            $query->andFilterWhere(['<', 'Data_Coleta',
                \DateTime::createFromFormat("d/m/Y", $this->dataFim)->format("Y-m-d H:i")]);
        }

        return $dataProvider;
    }

    public static function defaultSearch()
    {
        $query = Exportacao::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

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
