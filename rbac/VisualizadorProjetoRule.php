<?php
/**
 * Description of newPHPClass
 *
 * @author schvarcz
 */
namespace app\rbac;

use yii\rbac\Rule;

class VisualizadorProjetoRule extends Rule
{
    public $name = "VisualizadorProjeto";
    
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
            foreach($params['projeto']->getPesquisadoresWhoHasPermissoes()->all() as $pesquisador)
            {
                if ($pesquisador->idPesquisador == $user)
                {
                    return true;
                }
            }
            if ($params['projeto']->idProjetoPai)
            {
                return \Yii::$app->user->can("verProjeto", ["projeto" => $params['projeto']->idProjetoPai0]);
            }
            foreach (\app\models\Projeto::find()->andWhere(["idProjetoPai" => $params['projeto']->primaryKey]) as $projetoFilho)
            {
                if (\Yii::$app->user->can("verProjeto",["projeto"=>$projetoFilho]))
                {
                    return true;
                }
            }
        }
        else
        {
            if (\app\models\Projeto::find()->joinWith("pesquisadorHasPermissoes")->andWhere(["idPesquisador" => $user])->count() != 0)
            {
                return true;
            }
        }
        return false;
    }
}
