<?php

namespace app\models\base;

use Yii;

/**
 * This is the base-model class for table "ColetaItemPropriedade".
 *
 * @property integer $idColetaItemPropriedade
 * @property integer $idColetaItem
 * @property integer $idDescritor
 * @property string $value
 * @property integer $impossivelColetar
 *
 * @property ColetaItem $idColetaItem0
 * @property Descritor $idDescritor0
 */
class ColetaItemPropriedade extends \app\models\MActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ColetaItemPropriedade';
    }

    /**
     * @inheritdoc
     */
    public function getLabel()
    {
        return $this->idColetaItem;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idColetaItem', 'idDescritor'], 'required'],
            [['idColetaItem', 'idDescritor', 'impossivelColetar'], 'integer'],
            [['value'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'idColetaItemPropriedade' => Yii::t('app', 'Id Coleta Item Propriedade'),
            'idColetaItem' => Yii::t('app', 'Id Coleta Item'),
            'idDescritor' => Yii::t('app', 'Id Descritor'),
            'value' => Yii::t('app', 'Value'),
            'impossivelColetar' => Yii::t('app', 'Impossivel Coletar'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdColetaItem0()
    {
        return $this->hasOne(\app\models\ColetaItem::className(), ['idColetaItem' => 'idColetaItem']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDescritor0()
    {
        return $this->hasOne(\app\models\Descritor::className(), ['idDescritor' => 'idDescritor']);
    }

}
