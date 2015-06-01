<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Pesquisador".
 * 
 * @property UploadedFile $photo 
 */
class Pesquisador extends \app\models\base\Pesquisador
{
    public $photo;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(),
                [
            [['photo'], 'file']
        ]);
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idPesquisador' => Yii::t('app', 'Identificador do Pesquisador'),
            'Nome' => Yii::t('app', 'Nome'),
            'email' => Yii::t('app', 'Email'),
            'lattes' => Yii::t('app', 'Lattes'),
            'login' => Yii::t('app', 'Login'),
            'senha' => Yii::t('app', 'Senha'),
            'foto' => Yii::t('app', 'Foto'),
            'photo' => Yii::t('app', 'Foto'),
            'Resumo' => Yii::t('app', 'Resumo'),
        ];
    }
}
