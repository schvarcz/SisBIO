<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoDado;

/**
 * TipoDadoSearch represents the model behind the search form about TipoDado.
 */
class TipoDadoSearch extends Model
{

    public $idTipoDado;
    public $Tipo;
    public $Descricao;

    public function rules()
    {
        return [
            [['idTipoDado'], 'integer'],
            [['Tipo', 'Descricao'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoDado' => 'Id Tipo Dado',
            'Tipo' => 'Tipo',
            'Descricao' => 'Descricao',
        ];
    }

    public function search($params)
    {
        $query = TipoDado::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idTipoDado' => $this->idTipoDado,
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
