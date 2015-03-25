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
        $saved = $this->load($_POST) && $this->save();
        if ($saved)
        {
            $scope = $formName === null ? $this->formName() : $formName;
            if ($scope)
                $data = $data[$scope];

            foreach ($data as $dataName => $dataValue)
            {
                $relation = $this->getRelation($dataName, false);
                if ($relation && $relation->multiple)
                {
                    foreach ($relation->all() as $modelRelation)
                    {
                        print_r($modelRelation);
                        $this->unlink("$dataName", $modelRelation, true);
                    }

                    if (is_array($dataValue))
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
            return true;
        }
        return $saved;
    }

}
