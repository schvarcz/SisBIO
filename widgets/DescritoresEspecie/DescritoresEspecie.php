<?php

/**
 * Description of DescritoresEspecie
 *
 * @author Schvarcz
 */

namespace app\widgets\DescritoresEspecie;

use yii\widgets\InputWidget;
use yii\helpers\Html;
use app\models\ColetaItem;
use app\models\Coleta;
use app\models\ColetaItemPropriedade;
use app\widgets\DescritoresEspecie\ActiveField;

class DescritoresEspecie extends InputWidget
{

    private $hash;
    private $propCounter = 1;
    public $tipoDescritor = 1;
    private static $key = 1;

    public function init()
    {
        parent::init();

        $model = $this->model;
        if ($model instanceof \app\models\base\Especie)
        {
            $this->newFieldSet($model);
        }
        elseif($model instanceof \app\models\base\Coleta)
        {
            $this->editColeta($model);
        }
        
    }

    /**
     * Generates an appropriate input name for the specified attribute name or expression.
     *
     * This method generates a name that can be used as the input name to collect user input
     * for the specified attribute. The name is generated according to the [[Model::formName|form name]]
     * of the model and the given attribute name. For example, if the form name of the `Post` model
     * is `Post`, then the input name generated for the `content` attribute would be `Post[content]`.
     *
     * See [[getAttributeName()]] for explanation of attribute expression.
     *
     * @param Coleta $model the model object
     * @param string $attribute the attribute name or expression
     * @return string the generated input name
     * @throws InvalidParamException if the attribute name contains non-word characters.
     */
    public function editColeta($model)
    {
        foreach($model->getColetaItems()->select("ColetaItem.*")->joinWith(
            "coletaItemPropriedades.idDescritor0",true,"INNER JOIN")->where(["idTipoDescritor" =>$this->tipoDescritor])->all() as $coletaItem)
        {
            echo Html::beginTag("fieldset", ["class" =>"coleta"]);
            echo Html::beginTag("legend");
            echo Html::label($coletaItem->idEspecie0->getLabel());
            echo Html::label("&times;",null,["class" => "btn-primary close-btn"]);
            echo Html::endTag("legend");

            $this->hash = md5(time() +DescritoresEspecie::$key);
            DescritoresEspecie::$key++;

            echo Html::activeHiddenInput($coletaItem, "idEspecie", ["name" => $this->getInputName($model, "coletaItems.idEspecie")]);
            foreach($coletaItem->coletaItemPropriedades as $coletaItemProp)
            {
                $descritor = $coletaItemProp->idDescritor0;
                echo Html::beginTag("div",["class" => "form-group"]);

                echo Html::activeHiddenInput($coletaItemProp, "idTipoOrganismo", ["name" => $this->getInputName($model, "coletaItems.coletaItemPropriedades.idTipoOrganismo")]);
                echo Html::activeHiddenInput($coletaItemProp, "idDescritor", ["name" => $this->getInputName($model, "coletaItems.coletaItemPropriedades.idDescritor")]);

                echo Html::label($descritor->Nome,null, ["class" => "control-label col-sm-2"]);
                echo Html::beginTag("div",["class" => "col-sm-8"]);
                $field = new ActiveField(["model" => $coletaItemProp, "attribute" => "value"]);
                switch ($descritor->idTipoDado)
                {
                    case 1:
                        $field->textInput(["name" => $this->getInputName($model, "coletaItems.coletaItemPropriedades.value")]);
                        break;
                    case 2:
                        $field->textInput(["name" => $this->getInputName($model, "coletaItems.coletaItemPropriedades.value")]);
                        break;
                    case 3:
                        $field->textInput(["name" => $this->getInputName($model, "coletaItems.coletaItemPropriedades.value")]);
                        break;
                    case 4:
                        $field->textarea(["name" => $this->getInputName($model, "coletaItems.coletaItemPropriedades.value")]);
                        break;
                }
                $field->label(false);
                $this->propCounter++;
                echo $field;
                
                echo Html::endTag("div");
                echo Html::endTag("div");
            }
            echo Html::endTag("fieldset");
        }
    }
    public function newFieldSet($model)
    {
        echo Html::beginTag("fieldset", ["class" =>"coleta"]);
        echo Html::beginTag("legend");
        echo Html::label($model->getLabel());
        echo Html::label("&times;",null,["class" => "btn-primary close-btn"]);
        echo Html::endTag("legend");

        $coleta = new Coleta();
        $coletaItem = new ColetaItem();
        $coletaItem->idEspecie = $model;
        $this->hash = md5(time());

        echo Html::activeHiddenInput($coletaItem, "idEspecie", ["name" => $this->getInputName($coleta, "coletaItems.idEspecie")]);

        $descritores = $model->idTipoOrganismo->getIdDescritores()->where([
            "idTipoDescritor" => $this->tipoDescritor // PAYATTETION: Descritores Funcionais 
        ])->all();

        foreach ($descritores as $descritor)
        {
            $coletaItemProp = new ColetaItemPropriedade([
                "idTipoOrganismo" => $model->idTipoOrganismo,
                "idDescritor" => $descritor,
            ]);
            echo Html::beginTag("div",["class" => "form-group"]);

            echo Html::activeHiddenInput($coletaItemProp, "idTipoOrganismo", ["name" => $this->getInputName($coleta, "coletaItems.coletaItemPropriedades.idTipoOrganismo")]);
            echo Html::activeHiddenInput($coletaItemProp, "idDescritor", ["name" => $this->getInputName($coleta, "coletaItems.coletaItemPropriedades.idDescritor")]);

            echo Html::label($descritor->Nome,null, ["class" => "control-label col-sm-2"]);
            $field = new ActiveField(["model" => $coletaItemProp, "attribute" => "value"]);
            switch ($descritor->idTipoDado)
            {
                case 1:
                    $field->textInput(["name" => $this->getInputName($coleta, "coletaItems.coletaItemPropriedades.value")]);
                    break;
                case 2:
                    $field->textInput(["name" => $this->getInputName($coleta, "coletaItems.coletaItemPropriedades.value")]);
                    break;
                case 3:
                    $field->textInput(["name" => $this->getInputName($coleta, "coletaItems.coletaItemPropriedades.value")]);
                    break;
                case 4:
                    $field->textarea(["name" => $this->getInputName($coleta, "coletaItems.coletaItemPropriedades.value")]);
                    break;
            }
            $field->label(false);
            $this->propCounter++;
            
            echo Html::tag("div",$field,["class" => "col-sm-8"]);
            echo Html::endTag("div");
        }
        echo Html::endTag("fieldset");
    }
    /**
     * Generates an appropriate input name for the specified attribute name or expression.
     *
     * This method generates a name that can be used as the input name to collect user input
     * for the specified attribute. The name is generated according to the [[Model::formName|form name]]
     * of the model and the given attribute name. For example, if the form name of the `Post` model
     * is `Post`, then the input name generated for the `content` attribute would be `Post[content]`.
     *
     * See [[getAttributeName()]] for explanation of attribute expression.
     *
     * @param Model $model the model object
     * @param string $attribute the attribute name or expression
     * @return string the generated input name
     * @throws InvalidParamException if the attribute name contains non-word characters.
     */
    public function getInputName($model, $attribute)
    {
        $formName = $model->formName();
        if (!preg_match_all('/(\.?)([\[\w\]]+)(\.?)/', $attribute, $matches))
        {
            throw new InvalidParamException('Attribute name must contain word characters only.');
        }

        $attribute = $matches[2];

        $modelV = $model;
        $attributeName = "";
        $lastIdx = count($attribute) - 1;
        foreach ($attribute as $attr)
        {
            $method = "get" . $attr;
            if (method_exists($modelV, $method))
            {

                $modelAttr = $modelV->$method();
                if ($modelAttr->multiple)
                {
                    //Verificar se é multiplo
                    if ($modelV == $model)
                        $attributeName .= "[" . $attr . "]" . "[" . $this->hash . "]";
                    elseif ($attribute[$lastIdx] == $attr)
                        $attributeName .= "[" . $attr . "]" . "[]";
                    else
                        $attributeName .= "[" . $attr . "]" . "[" . $this->propCounter . "]";
                }
                $modelV = new $modelAttr->modelClass;
            }
            if (key_exists($attr, $modelV->attributes))
                $attributeName .= "[" . $attr . "]";
        }
        if ($formName === '')
        {
            return $attributeName;
        } elseif ($formName !== '')
        {
            return $formName . $attributeName;
        } else
        {
            throw new InvalidParamException(get_class($model) . '::formName() cannot be empty for tabular inputs.');
        }
    }

}
