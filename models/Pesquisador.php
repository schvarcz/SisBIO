<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Pesquisador".
 */
class Pesquisador extends \app\models\base\Pesquisador implements \yii\web\IdentityInterface
{

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
            'senha' => Yii::t('app', 'Senha'),
            'foto' => Yii::t('app', 'Foto'),
            'Resumo' => Yii::t('app', 'Resumo'),
        ];
    }

    public function beforeSave($event)
    {
        if (array_key_exists("senha",$this->oldAttributes) && $this->senha != $this->oldAttributes["senha"])
        {
            $this->senha = md5($this->senha);
            $this->authKey = Null;
        }
        return parent::beforeSave($event);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return Pesquisador::findOne([Pesquisador::primaryKey()[0] => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user)
        {
            if ($user['accessToken'] === $token)
            {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->primaryKey;
    }

    /**
     * @inheritdoc
     */
    public function getUsername()
    {
        return $this->Nome;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return md5($this->primaryKey . time()); //$this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Finds user by email
     *
     * @param  string      $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return Pesquisador::findOne(["email" => $email]);
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->senha === md5($password);
    }

    /**
     * @inheritdoc
     */
    public function generateAuthKey()
    {
        $this->authKey = $this->getAuthKey();
        return $this->save();
    }

}
