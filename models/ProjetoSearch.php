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
            [['idProjeto'], 'integer'],
            [['Nome', 'Data_Inicio', 'Data_Fim', 'Descricao', 'idPesquisadorResponsavel', 'ativo'], 'safe'],
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
        $query = null;
        
        if (\Yii::$app->user->can("adminBase"))
        {
            $query = Projeto::find();
        }
        else
        {
            if (\Yii::$app->user->can("adminProjeto"))
            {
                $query = Projeto::find();
                $query->orWhere(["idPesquisadorResponsavel" => \Yii::$app->user->id]);
            }
            if (\Yii::$app->user->can("colaboradorProjeto"))
            {
                if (is_null($query))
                {
                    $query = Projeto::find();
                }
                $query->joinWith("idPesquisadores");
                $query->orWhere(["Pesquisador_has_Projeto.idPesquisador" => \Yii::$app->user->id]);
            }
            if (\Yii::$app->user->can("operadorColeta"))
            {
                if (is_null($query))
                {
                    $query = Projeto::find();
                }
                $query->joinWith("pesquisadorHasPermissoes");
                $query->orWhere(["Pesquisador_has_Permissoes.idPesquisador" => \Yii::$app->user->id]);
            }
        }
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }
        
        $query->andFilterWhere([
            'idProjeto' => $this->idProjeto,
            'Data_Inicio' => $date,
            'Data_Fim' => $this->Data_Fim,
            'ativo' => (strtolower($this->ativo)=="sim"||trim($this->ativo)=="")?1:0,
        ]);
        if(trim($this->idPesquisadorResponsavel))
            $query->joinWith("idPesquisadorResponsavel0", true, "INNER JOIN")->andFilterWhere(['like', 'Pesquisador.Nome', $this->idPesquisadorResponsavel]);

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
