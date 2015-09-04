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
use app\models\Especie;
use app\models\TipoOrganismo;
use app\models\ColetaItemPropriedade;
use app\models\NaoIdentificado;
use app\models\Descritor;
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
        if ($model instanceof Especie)
        {
            $this->newFieldSetEspecie($model);
        } elseif ($model instanceof TipoOrganismo)
        {
            $this->newFieldSetTipoOrganismo($model);
        } elseif ($model instanceof Descritor)
        {
            $this->newFieldSetDescritor($model);
        } elseif ($model instanceof Coleta)
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
        foreach ($model->getColetaItems()->select("ColetaItem.*")->joinWith(
                "coletaItemPropriedades.idDescritor0", true, "INNER JOIN")->where(["idTipoDescritor" => $this->tipoDescritor])->all() as $coletaItem)
        {
            echo Html::beginTag("fieldset", ["class" => "coleta"]);
            echo Html::beginTag("legend");
            if ($coletaItem->idEspecie0 != null)
                $modelItem = $coletaItem->idEspecie0;
            elseif ($coletaItem->idNaoIdentificado0 != null)
                $modelItem = $coletaItem->idNaoIdentificado0;
            else
                $modelItem = $coletaItem->coletaItemPropriedades[0]->idDescritor0;

            echo Html::label($modelItem->getLabel());
            echo Html::label("&times;", null, ["class" => "btn-primary close-btn"]);
            echo Html::endTag("legend");

            $this->hash = md5(time() + DescritoresEspecie::$key);
            DescritoresEspecie::$key++;

            echo Html::activeHiddenInput($coletaItem, "idEspecie", ["name" => $this->getInputName($model, "coletaItems.idEspecie")]);
            echo Html::activeHiddenInput($coletaItem, "idNaoIdentificado", ["name" => $this->getInputName($model, "coletaItems.idNaoIdentificado")]);
            echo Html::hiddenInput("idTipoOrganismo", $coletaItem->idEspecie ? $coletaItem->idEspecie0->idTipo_Organismo : $coletaItem->idNaoIdentificado0->idTipoOrganismo, ["class" => "idTipoOrganismo"]);
            foreach ($coletaItem->coletaItemPropriedades as $coletaItemProp)
            {
                $descritor = $coletaItemProp->idDescritor0;

                $this->generateDescritorField($model, $coletaItemProp, $descritor);
            }
            echo Html::endTag("fieldset");
        }
    }

    /**
     * @param Especie $model the model object
     * @return string the generated input name
     */
    public function newFieldSetEspecie($model)
    {
        echo Html::beginTag("fieldset", ["class" => "coleta"]);
        echo Html::beginTag("legend");
        echo Html::label($model->getLabel());
        echo Html::label("&times;", null, ["class" => "btn-primary close-btn"]);
        echo Html::endTag("legend");

        $coleta = new Coleta();
        $coletaItem = new ColetaItem();
        $coletaItem->idEspecie = $model;
        $this->hash = md5(time());

        echo Html::activeHiddenInput($coletaItem, "idEspecie", ["name" => $this->getInputName($coleta, "coletaItems.idEspecie")]);
        echo Html::hiddenInput("idTipoOrganismo", $coletaItem->idEspecie->idTipo_Organismo, ["class" => "idTipoOrganismo"]);

        $descritores = $model->idTipoOrganismo->getIdDescritores()->where([
                    "idTipoDescritor" => $this->tipoDescritor
                ])->all();

        foreach ($descritores as $descritor)
        {
            $coletaItemProp = new ColetaItemPropriedade([
                "idDescritor" => $descritor,
            ]);

            $this->generateDescritorField($coleta, $coletaItemProp, $descritor);
        }
        echo Html::endTag("fieldset");
    }

    /**
     * @param TipoOrganismo $model the model object
     * @return string the generated input name
     */
    public function newFieldSetTipoOrganismo($model)
    {
        echo Html::beginTag("fieldset", ["class" => "coleta"]);
        echo Html::beginTag("legend");
        echo Html::label($model->getLabel() . " - Não Identificado");
        echo Html::beginTag("sup");
        echo Html::label("&nbsp;", null, [
            "class" => "glyphicon glyphicon-info-sign btn-xs",
            "data-toogle" => "popover",
            "title" => "O nome para identificação do indivíduo será gerado após salvar este registro.",
            "data-content" => ""
        ]);
        echo Html::endTag("sup");
        echo Html::label("&times;", null, ["class" => "btn-primary close-btn"]);
        echo Html::endTag("legend");

        $coleta = new Coleta();
        $coletaItem = new ColetaItem();
        $naoIdentificado = new NaoIdentificado();
        $naoIdentificado->idTipoOrganismo = $model;
        $this->hash = md5(time());

        echo Html::activeHiddenInput($naoIdentificado, "idTipoOrganismo", ["name" => $this->getInputName($coleta, "coletaItems.idNaoIdentificado0.idTipoOrganismo"), "class" => "idTipoOrganismo"]);

        $descritores = $model->getIdDescritores()->where([
                    "idTipoDescritor" => $this->tipoDescritor
                ])->all();

        foreach ($descritores as $descritor)
        {
            $coletaItemProp = new ColetaItemPropriedade([
                "idDescritor" => $descritor,
            ]);

            $this->generateDescritorField($coleta, $coletaItemProp, $descritor);
        }
        echo Html::endTag("fieldset");
    }

    /**
     * @param TipoOrganismo $model the model object
     * @return string the generated input name
     */
    public function newFieldSetDescritor($model)
    {
        echo Html::beginTag("fieldset", ["class" => "coleta"]);
        echo Html::beginTag("legend");
        echo Html::label($model->getLabel());
        echo Html::label("&times;", null, ["class" => "btn-primary close-btn"]);
        echo Html::endTag("legend");

        $this->hash = md5(time());


        $coleta = new Coleta();
        $coletaItemProp = new ColetaItemPropriedade([
            "idDescritor" => $model,
        ]);

        $this->generateDescritorField($coleta, $coletaItemProp, $model);

        echo Html::endTag("fieldset");
    }

    public function generateDescritorField($coleta, $coletaItemProp, $descritor)
    {
        echo Html::beginTag("div", ["class" => "form-group"]);

        echo Html::activeHiddenInput($coletaItemProp, "idDescritor", ["name" => $this->getInputName($coleta, "coletaItems.coletaItemPropriedades.idDescritor"), "class" => "idDescritor"]);

        echo Html::label($descritor->Nome, null, ["class" => "control-label col-sm-2"]);
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

        echo Html::tag("div", $field, ["class" => "col-sm-8"]);
        echo Html::endTag("div");
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
            $relation = $modelV->getRelation($attr, false);
            if ($relation)
            {
                if ($relation->multiple)
                {
                    //Verificar se é multiplo
                    if ($modelV == $model)
                        $attributeName .= "[" . $attr . "]" . "[" . $this->hash . "]";
                    elseif ($attribute[$lastIdx] == $attr)
                        $attributeName .= "[" . $attr . "]" . "[]";
                    else
                        $attributeName .= "[" . $attr . "]" . "[" . $this->propCounter . "]";
                }
                else
                {
                    $attributeName .= "[" . $attr . "]";
                }
                $modelV = new $relation->modelClass;
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
