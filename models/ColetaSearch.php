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
    public $idMetodo;
    public $coordenadaGeografica;
    public $idPesquisadorRegistro;

    public function rules()
    {
        return [
            [['idColeta'], 'integer'],
            [['idUnidadeGeografica', 'idMetodo', 'idPesquisadorRegistro', 'Data_Coleta', 'Observacao', 'coordenadaGeografica'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idColeta' => 'Identificador da Coleta',
            'Data_Coleta' => 'Data da Coleta',
            'Observacao' => 'Observação',
            'idUnidadeGeografica' => 'Unidade Geográfica',
            'idMetodo' => 'Método de Coleta',
            'coordenadaGeografica' => 'Coordenada Geográfica',
            'idPesquisadorRegistro' => 'Pesquisador responsável pelo registro',
        ];
    }

    public function search($params)
    {
        $query = null;
        
        if (\Yii::$app->user->can("adminBase"))
        {
            $query = Coleta::find();
        }
        elseif (\Yii::$app->user->can("adminColeta"))
        {
            $query = Coleta::find();
            $query->joinWith("idUnidadeGeografica0.idProjeto0");
            $query->orWhere(["idPesquisadorResponsavel" => \Yii::$app->user->id]);
            
            $query->joinWith("idUnidadeGeografica0.idProjeto0.idPesquisadores");
            $query->orWhere(["Pesquisador_has_Projeto.idPesquisador" => \Yii::$app->user->id]);
                
            $query->joinWith("idUnidadeGeografica0.idProjeto0.pesquisadorHasPermissoes");
            $query->orWhere(["Pesquisador_has_Permissoes.idPesquisador" => \Yii::$app->user->id,"Pesquisador_has_Permissoes.idPermissoes" => 1]);
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idColeta' => $this->idColeta,
            'Data_Coleta' => $this->Data_Coleta,
        ]);

        $query->andFilterWhere(['like', 'Observacao', $this->Observacao])
                ->andFilterWhere(['like', 'coordenadaGeografica', $this->coordenadaGeografica])
                ->joinWith("idUnidadeGeografica0", true, "INNER JOIN")->andFilterWhere(['like', 'UnidadeGeografica.Nome', $this->idUnidadeGeografica])
                ->joinWith("idMetodo0", true, "INNER JOIN")->andFilterWhere(['like', 'Metodo.Nome', $this->idMetodo])
                ->joinWith("idPesquisadorRegistro0", true, "INNER JOIN")->andFilterWhere(['like', 'Pesquisador.Nome', $this->idPesquisadorRegistro]);

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
