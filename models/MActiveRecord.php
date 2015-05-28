<?php

/**
 * Description of MActiveRecord
 *
 * @author schvarcz
 */

namespace app\models;

class MActiveRecord extends \yii\db\ActiveRecord
{

    public function saveWithRelated($data, $formName = null)
    {
        $saved = $this->load($data) && $this->save();
        if ($saved)
        {
            $scope = $formName === null ? $this->formName() : $formName;
            if ($scope)
                $data = $data[$scope];

            foreach ($data as $dataName => $dataValue)
            {
                $relation = $this->getRelation($dataName, false);
                if ($relation)
                {
                    if($relation->multiple)
                    {
                        foreach ($relation->all() as $modelRelation)
                        {
                            $this->unlink("$dataName", $modelRelation, true);
                        }

                        if (is_array($dataValue))
                        {
                            if (is_array($dataValue[array_keys($dataValue)[0]]))
                            {
                                foreach ($dataValue as $value)
                                {
                                    $modelRelation = new $relation->modelClass;
                                    
                                    //We dont use $this->link here, because that method save the model in the database and we are not ready to that yet.
                                    foreach($relation->link as $keyModel => $keyRelation)
                                    {
                                        $modelRelation->$keyRelation = $this->$keyModel;
                                    }
                                    $modelRelation->saveWithRelated([$modelRelation->formName()=>$value]);
                                }
                            }
                            else
                            {
                                foreach ($dataValue as $value)
                                {
                                    $modelRelationClass = $relation->modelClass;
                                    $modelRelation = $modelRelationClass::findOne($value);
                                    $this->link("$dataName", $modelRelation);
                                }
                            }
                        }
                    }
                    elseif (is_array($dataValue))
                    {
                        if($this->$dataName != null)
                            $modelRelation = $this->$dataName;
                        else
                            $modelRelation = new $relation->modelClass;
                        $modelRelation->saveWithRelated([$modelRelation->formName()=>$dataValue]);
                        $this->link("$dataName", $modelRelation);
                    }
                }
            }
//            if ($this->className() == "app\models\Coleta")
//            exit();
            return true;
        }
        return $saved;
    }

    public function beforeSave($event)
    {
        $dateFormats = ["date"=>"d/m/Y", "datetime" =>"d/m/Y H:i", "timestamp"=>"d/m/Y H:i"];
        foreach ($this->attributes as $name => $value)
        {
            if($value)
            {
                $type = $this->getTableSchema()->getColumn($name)->dbType;
                if (isset($dateFormats[$type]))
                {
                    $date = \DateTime::createFromFormat($dateFormats[$type], $value);
                        $this->$name = $date->format("Y-m-d H:i");
                }
            }
        }
        return parent::beforeSave($event);
    }
  
    public function afterFind()
    {
        $dateFormats = ["date"=>"d/m/Y", "datetime" =>"d/m/Y H:i", "timestamp"=>"d/m/Y H:i"];
        foreach ($this->attributes as $name => $value)
        {
            if($value)
            {
                $type = $this->getTableSchema()->getColumn($name)->dbType;
                if (isset($dateFormats[$type]))
                {
                    $date = new \DateTime($value);
                    $this->$name = $date->format($dateFormats[$type]);
                }
            }
        }
        parent::afterFind();
    }

}
