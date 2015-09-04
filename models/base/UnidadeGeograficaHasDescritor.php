<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "UnidadeGeografica_has_Descritor".
 *
 * @property integer $idUnidadeGeografica
 * @property integer $idDescritor
 */
class UnidadeGeograficaHasDescritor extends \app\models\MActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'UnidadeGeografica_has_Descritor';
    }

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->idDescritor;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idUnidadeGeografica', 'idDescritor'], 'required'],
            [['idUnidadeGeografica', 'idDescritor'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idUnidadeGeografica' => Yii::t('app', 'Id Unidade Geografica'),
            'idDescritor' => Yii::t('app', 'Id Descritor'),
        ];
    }

}
