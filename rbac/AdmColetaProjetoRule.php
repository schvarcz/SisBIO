<?php
/**
 * Description of newPHPClass
 *
 * @author schvarcz
 */
namespace app\rbac;

use yii\rbac\Rule;

class AdmColetaProjetoRule extends Rule
{
    public $name = "AdmColetaProjeto";
    
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
            foreach($params['projeto']->getViewPesquisadorPermissoes()->andWhere(["idPesquisador" => $user])->all() as $permissao)
            {
                if ($permissao->attributes["Administrar Coletas"])
                {
                    return true;
                }
            }
        }
        else
        {
            if (\app\models\Projeto::find()->joinWith("pesquisadorHasPermissoes")
                    ->andWhere(["idPesquisador" => $user,"idPermissoes" => 1]) //Adm coleta
                    ->count() != 0)
            {
                return true;
            }
        }
        return false;
    }
}
