<?php
/**
 * Description of newPHPClass
 *
 * @author schvarcz
 */
namespace app\rbac;

use yii\rbac\Rule;

class CuradoriaRule extends Rule
{
    public $name = "Curadoria";
    
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
        if(isset($params['tipoOrganismo']))
        {
            if($params['tipoOrganismo']->getCuradorias()->andWhere(["idPesquisador" => $user])->count() != 0)
            {
                return true;
            }
        }
        else
        {
            if (\app\models\Curadoria::find()
                    ->andWhere(["idPesquisador" => $user])
                    ->count() != 0)
            {
                return true;
            }
        }
        return false;
    }
}
