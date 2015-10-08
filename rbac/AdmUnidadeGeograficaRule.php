<?php
/**
 * Description of newPHPClass
 *
 * @author schvarcz
 */
namespace app\rbac;

use yii\rbac\Rule;

class AdmUnidadeGeograficaRule extends Rule
{
    public $name = "AdmUnidadeGeografica";
    
    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        if (\Yii::$app->user->can("editarProjeto",$params))
        {
            return true;
        }
        if(isset($params['projeto']))
        {
            //ver se ele está vinculado como operador de unidade geografica do projeto.
            foreach($params['projeto']->getViewPesquisadorPermissoes()->andWhere(["idPesquisador" => \yii::$app->user->id])->all() as $permissao)
            {
                if ($permissao->attributes["Administrar Unidades Geográficas"])
                {
                    return true;
                }
            }
            if ($params['projeto']->idProjetoPai)
            {
                return \Yii::$app->user->can("editarProjeto", ["projeto" => $params['projeto']->idProjetoPai0]);
            }
        }
        return false;
    }
}
