<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "viewpesquisadorpermissoes".
 *
 * @property integer $idProjeto
 * @property integer $idPesquisador
 * @property string $Administrar Coletas
 * @property string $Administrar Unidades Geográficas
 * @property string $Visualizar dados
 * @property string $Exportar dados
 */
class Viewpesquisadorpermissoes extends \app\models\MActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'viewpesquisadorpermissoes';
    }
    
    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->idPesquisador;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idProjeto', 'idPesquisador'], 'required'],
            [['idProjeto', 'idPesquisador'], 'integer'],
            [['Administrar Coletas', 'Administrar Unidades Geográficas', 'Visualizar dados', 'Exportar dados'], 'string', 'max' => 3]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idProjeto' => Yii::t('app', 'Id Projeto'),
            'idPesquisador' => Yii::t('app', 'Id Pesquisador'),
            'Administrar Coletas' => Yii::t('app', 'Administrar  Coletas'),
            'Administrar Unidades Geográficas' => Yii::t('app', 'Administrar  Unidades  Geográficas'),
            'Visualizar dados' => Yii::t('app', 'Visualizar Dados'),
            'Exportar dados' => Yii::t('app', 'Exportar Dados'),
        ];
    }
}
