<?php

/**
 * Description of PermissaoProjeto
 *
 * @author Schvarcz
 */

namespace app\widgets\PermissaoProjeto;

use app\widgets\DescritoresEspecie\ActiveField;
use yii\widgets\InputWidget;
use app\models\base\Pesquisador;
use app\models\Permissoes;
use app\models\Projeto;
use app\models\PesquisadorHasPermissoes;
use yii\helpers\Html;

class PermissaoProjeto extends InputWidget
{

    private $hash;
    private $propCounter = 1;
    public $tipoDescritor = 1;
    private static $key = 1;

    public function init()
    {
        parent::init();

        $model = $this->model;
        if ($model instanceof Pesquisador)
        {
            //Novo widget
            $this->newPermission($model);
        } elseif ($model instanceof Projeto)
        {
            //Editar permissoes existentes
            echo Html::beginTag("table",["class" =>"table table-hover ", "style"=>"margin-top:30px"]);
            $this->header();
            $this->body($model);
            echo Html::endTag("table");
        }
    }
    
    public function newPermission($pesquisador)
    {
        echo Html::beginTag("tr");
        echo Html::tag("th",
                $pesquisador->getLabel(),
                ["class" => "text-left"]
        );
        
        $projeto = new Projeto();
        
        foreach(Permissoes::find()->all() as $permission)
        {
            $this->hash = md5(time(). PermissaoProjeto::$key);
            echo Html::tag("td",
                    Html::hiddenInput($this->getInputName($projeto,"Projeto.pesquisadorHasPermissoes.idPesquisador"),$pesquisador->idPesquisador).
                    Html::checkbox($this->getInputName($projeto,"Projeto.pesquisadorHasPermissoes.idPermissoes"),false,["value"=> $permission->idPermissoes])
            );
            PermissaoProjeto::$key++;
        }
        
        echo Html::endTag("tr");
    }
    
    public function header()
    {
        echo Html::beginTag("thead",["class" =>"text-center"]);
        echo Html::beginTag("tr");
        echo Html::tag("td","&nbsp;");
        foreach(Permissoes::find()->all() as $permission)
        {
            echo Html::tag("td",
                    Html::tag("strong", $permission->getLabel())
                    ,[]);
        }
        echo Html::endTag("tr");
        echo Html::endTag("thead");
    }
    
    public function body($projeto)
    {
        echo Html::beginTag("tbody",["class" =>"text-center pesquisadoresPermissao"]);
        
        foreach($projeto->pesquisadoresWhoHasPermissoes as $pesquisador)
        {
            echo Html::beginTag("tr");
            echo Html::tag("th",
                    $pesquisador->getLabel(),
                    ["class" => "text-left"]
            );
            
            foreach(Permissoes::find()->all() as $permission)
            {
                $this->hash = md5(time(). PermissaoProjeto::$key);
                echo Html::tag("td",
                        Html::hiddenInput($this->getInputName($projeto,"Projeto.pesquisadorHasPermissoes.idPesquisador"),$pesquisador->idPesquisador).
                        Html::checkbox($this->getInputName($projeto,"Projeto.pesquisadorHasPermissoes.idPermissoes"),
                        PesquisadorHasPermissoes::findOne(["idPesquisador" => $pesquisador->idPesquisador,"idProjeto" => $projeto->idProjeto,"idPermissoes" => $permission->idPermissoes])?TRUE:FALSE
                                ,["value"=> $permission->idPermissoes])
                );
                PermissaoProjeto::$key++;
            }
            echo Html::endTag("tr");
        }
        echo Html::endTag("tbody");
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
