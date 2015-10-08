<?php
/**
 * Description of newPHPClass
 *
 * @author schvarcz
 */
namespace app\rbac;

use yii\rbac\Rule;

class ResponsavelProjetoRule extends Rule
{
    public $name = "ResponsavelProjeto";
    
    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        if (\Yii::$app->user->can("adminBase"))
        {
            return true;
        }
        
        if (isset($params['projeto']))
        {
            if ($params['projeto']->idPesquisadorResponsavel == $user)
            {
                return true;
            }

            if ($params['projeto']->idProjetoPai)
            {
                return \Yii::$app->user->can("deletarProjeto", ["projeto" => $params['projeto']->idProjetoPai0]);
            }
        }
        else
        {
            if (\app\models\Projeto::find()->andWhere(["idPesquisadorResponsavel" => $user])->count() != 0)
            {
                return true;
            }
        }
        return false;
    }
}
