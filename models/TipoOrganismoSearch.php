<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TipoOrganismo;

/**
 * TipoOrganismoSearch represents the model behind the search form about TipoOrganismo.
 */
class TipoOrganismoSearch extends Model
{

    public $idTipoOrganismo;
    public $Nome;
    public $Descricao;

    public function rules()
    {
        return [
            [['idTipoOrganismo'], 'integer'],
            [['Nome', 'Descricao'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idTipoOrganismo' => 'Id Tipo de Organismo',
            'Nome' => 'Nome',
            'Descricao' => 'Descricao',
        ];
    }

    public function search($params)
    {
        $query = TipoOrganismo::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate()))
        {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idTipoOrganismo' => $this->idTipoOrganismo,
        ]);

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
