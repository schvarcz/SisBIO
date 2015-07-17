<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoDescritor;

/**
 * TipoDescritorSearch represents the model behind the search form about TipoDescritor.
 */
class TipoDescritorSearch extends Model
{

    public $idTipoDescritor;
    public $Tipo;
    public $Descricao;

    public function rules()
    {
        return [
            [['idTipoDescritor'], 'integer'],
            [['Tipo', 'Descricao'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoDescritor' => 'Identificador do Tipo de Descritor',
            'Tipo' => 'Tipo de Descritor',
            'Descricao' => 'Descrição',
        ];
    }

    public function search($params)
    {
        $query = TipoDescritor::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idTipoDescritor' => $this->idTipoDescritor,
        ]);

        $query->andFilterWhere(['like', 'Tipo', $this->Tipo])
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
