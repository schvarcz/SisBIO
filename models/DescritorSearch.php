<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Descritor;

/**
 * DescritorSearch represents the model behind the search form about Descritor.
 */
class DescritorSearch extends Model
{

    public $idDescritor;
    public $Nome;
    public $idTipoDado;
    public $idTipoDescritor;
    public $Descricao;

    public function rules()
    {
        return [
            [['idDescritor'], 'integer'],
            [['Nome', 'Descricao', 'idTipoDado', 'idTipoDescritor'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idDescritor' => 'Id Descritor',
            'Nome' => 'Nome',
            'idTipoDado' => 'Id Tipo Dado',
            'idTipoDescritor' => 'Id Tipo de Descritor',
            'Descricao' => 'Descricao',
        ];
    }

    public function search($params)
    {
        $query = Descritor::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idDescritor' => $this->idDescritor,
        ]);
        
        if(trim($this->idTipoDado))
            $query->joinWith("idTipoDado0", true, "INNER JOIN")->andFilterWhere(['like', 'TipoDado.Tipo', $this->idTipoDado]);
        if(trim($this->idTipoDescritor))
            $query->joinWith("idTipoDescritor0", true, "INNER JOIN")->andFilterWhere(['like', 'TipoDescritor.Tipo', $this->idTipoDescritor]);

        $query->andFilterWhere(['like', 'Nome', $this->Nome])
                ->andFilterWhere(['like', 'Descritor.Descricao', $this->Descricao]);

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
