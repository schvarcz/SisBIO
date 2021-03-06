<?php


/**
 * Description of newPHPClass
 *
 * @author schvarcz
 */
namespace app\commands;

use yii\console\Controller;

class RbacController extends Controller
{
    public function actionCreate()
    {
        $auth = \Yii::$app->authManager;
        echo "Removing old permissions settigns... ";
        $auth->removeAll();

        
        //Cria permissões
        echo "done.\nCreating permissions... ";
        $adminProjeto = $auth->createPermission('adminProjetos');
        $adminProjeto->description = 'Administrador de todos projetos';
        $auth->add($adminProjeto);
        
        $adminCuradoria = $auth->createPermission('adminCuradoria');
        $adminCuradoria->description = 'Administrador de todas curadorias';
        $auth->add($adminCuradoria);
        
        $adminPesquisadores = $auth->createPermission('adminPesquisadores');
        $adminPesquisadores->description = 'Administrador de todos pesquisadores';
        $auth->add($adminPesquisadores);
        
        $admColetas = $auth->createPermission('admColetas');
        $admColetas->description = 'Administrador de todas coletas';
        $auth->add($admColetas);
        
        $adminUnidadeGeograficaSUPER = $auth->createPermission('adminUnidadeGeograficaSUPER');
        $adminUnidadeGeograficaSUPER->description = 'Administrador de todas Unidades Geográficas';
        $auth->add($adminUnidadeGeograficaSUPER);
        
        $adminTipoDados = $auth->createPermission('adminTipoDados');
        $adminTipoDados->description = 'Administrar Tipos de dados';
        $auth->add($adminTipoDados);
        
        
        
        
        $responsavelProjetoRule = new \app\rbac\ResponsavelProjetoRule;
        $auth->add($responsavelProjetoRule);
        $deletarProjetoProprio = $auth->createPermission('deletarProjeto');
        $deletarProjetoProprio->description = 'Deletar projeto';
        $deletarProjetoProprio->ruleName = $responsavelProjetoRule->name;
        $auth->add($deletarProjetoProprio);
        
        $trocarResponsavelProjeto = $auth->createPermission('trocarResponsavelProjeto');
        $trocarResponsavelProjeto->description = 'Trocar reponsável por projeto';
        $trocarResponsavelProjeto->ruleName = $responsavelProjetoRule->name;
        $auth->add($trocarResponsavelProjeto);
        
        
        
        
        $enviarConvites = $auth->createPermission('enviarConvites');
        $enviarConvites->description = 'Convidar novas pessoas ao sistema';
        $auth->add($enviarConvites);
        
        $colaboradorProjetoRule = new \app\rbac\ColaboradorProjetoRule;
        $auth->add($colaboradorProjetoRule);
        
        $adicionarOperadores = $auth->createPermission('adicionarOperadores');
        $adicionarOperadores->description = 'Atribuir funções de operador da base';
        $adicionarOperadores->ruleName = $colaboradorProjetoRule->name;
        $auth->add($adicionarOperadores);
        
        $editarProjeto = $auth->createPermission('editarProjeto');
        $editarProjeto->description = 'Editar projeto';
        $editarProjeto->ruleName = $colaboradorProjetoRule->name;
        $auth->add($editarProjeto);
        
        $criarSubprojeto = $auth->createPermission('criarSubprojeto');
        $criarSubprojeto->description = 'Criar subprojetos';
        $criarSubprojeto->ruleName = $colaboradorProjetoRule->name;
        $auth->add($criarSubprojeto);
        
        
        
        
        
        $visualizadorProjetoRule = new \app\rbac\VisualizadorProjetoRule;
        $auth->add($visualizadorProjetoRule);
        $verProjeto = $auth->createPermission('verProjeto');
        $verProjeto->description = 'Visualizar dados do projeto';
        $verProjeto->ruleName = $visualizadorProjetoRule->name;
        $auth->add($verProjeto);
        
        $admColetaRule = new \app\rbac\AdmColetaProjetoRule;
        $auth->add($admColetaRule);
        $adminColetaProjeto = $auth->createPermission('adminColeta');
        $adminColetaProjeto->description = 'Administrar coletas do projeto';
        $adminColetaProjeto->ruleName = $admColetaRule->name;
        $auth->add($adminColetaProjeto);
        $auth->addChild($adminColetaProjeto,$verProjeto);
        
        $admUnidadeGeograficaRule = new \app\rbac\AdmUnidadeGeograficaRule;
        $auth->add($admUnidadeGeograficaRule);
        $adminUnidadeGeograficaProjeto = $auth->createPermission('adminUnidadeGeografica');
        $adminUnidadeGeograficaProjeto->description = 'Administrar Uniidades Geográficas';
        $adminUnidadeGeograficaProjeto->ruleName = $admUnidadeGeograficaRule->name;
        $auth->add($adminUnidadeGeograficaProjeto);
        $auth->addChild($adminUnidadeGeograficaProjeto,$verProjeto);
        
        $exportar = $auth->createPermission('exportar');
        $exportar->description = 'Exportação dados do projeto';
        $auth->add($exportar);
        
        
        
        $curadoriaRule = new \app\rbac\CuradoriaRule;
        $auth->add($curadoriaRule);
        
        $adminDescritores = $auth->createPermission('adminDescritores');
        $adminDescritores->description = 'Administrar descritores';
        $adminDescritores->ruleName = $curadoriaRule->name;
        $auth->add($adminDescritores);
        
        $adminOrganismo = $auth->createPermission('adminOrganismo');
        $adminOrganismo->description = 'Administrar Tipos de Organismo';
        $adminOrganismo->ruleName = $curadoriaRule->name;
        $auth->add($adminOrganismo);
        
        $adminMetodos = $auth->createPermission('adminMetodos');
        $adminMetodos->description = 'Administrar Métodos de Coleta';
        $adminMetodos->ruleName = $curadoriaRule->name;
        $auth->add($adminMetodos);
        
        $adminTaxonomia = $auth->createPermission('adminTaxonomia');
        $adminTaxonomia->description = 'Administrar Taxonomia';
        $adminTaxonomia->ruleName = $curadoriaRule->name;
        $auth->add($adminTaxonomia);
        
        
        
        
        // Cria todas "role"
        echo "done.\nCreating roles... ";
        $operadorColeta = $auth->createRole('operadorColeta');
        $operadorColeta->description = "Operador da base";
        $auth->add($operadorColeta);
        
        $operadorUnidadeGeografica = $auth->createRole('operadorUnidadeGeografica');
        $operadorUnidadeGeografica->description = "Operador da base";
        $auth->add($operadorUnidadeGeografica);
        
        $operadorVisualizador = $auth->createRole('operadorVisualizador');
        $operadorVisualizador->description = "Operador da base: vizualização";
        $auth->add($operadorVisualizador);
        
        $operadorExportar = $auth->createRole('operadorExportar');
        $operadorExportar->description = "Operador da base";
        $auth->add($operadorExportar);
        
        $colaboradorProjeto = $auth->createRole('colaboradorProjeto');
        $colaboradorProjeto->description = "Pesquisador Colaborador do projeto";
        $auth->add($colaboradorProjeto);
        
        $adminProjetoRole = $auth->createRole('adminProjeto');
        $adminProjetoRole->description = "Administrador de projeto";
        $auth->add($adminProjetoRole);
        
        $curador = $auth->createRole('curador');
        $curador->description = "Curador de Grupo Biologico";
        $auth->add($curador);
        
        $adminBase = $auth->createRole('adminBase');
        $adminBase->description = "Administrador da Base";
        $auth->add($adminBase);
        
        
        
        //Atribui permissoes
        echo "done.\nAdding permissions to each role... ";
        $auth->addChild($operadorVisualizador, $verProjeto);
        
        $auth->addChild($operadorColeta, $adminColetaProjeto);
        
        $auth->addChild($operadorUnidadeGeografica, $adminUnidadeGeograficaProjeto);
        
        
        $auth->addChild($operadorExportar, $exportar);
        
        $auth->addChild($colaboradorProjeto, $enviarConvites);
        $auth->addChild($colaboradorProjeto, $adicionarOperadores);
        $auth->addChild($colaboradorProjeto, $editarProjeto);
        $auth->addChild($colaboradorProjeto, $criarSubprojeto);
        
        $auth->addChild($adminProjetoRole, $deletarProjetoProprio);
        $auth->addChild($adminProjetoRole, $trocarResponsavelProjeto);
        
        $auth->addChild($curador, $adminDescritores);
        $auth->addChild($curador, $adminOrganismo);
        $auth->addChild($curador, $adminMetodos);
        $auth->addChild($curador, $adminTaxonomia);
        
        $auth->addChild($adminBase, $adminProjeto);
        $auth->addChild($adminBase, $adminCuradoria);
        $auth->addChild($adminBase, $adminPesquisadores);
        $auth->addChild($adminBase, $admColetas); //Precisa?
        $auth->addChild($adminBase, $adminUnidadeGeograficaSUPER);//Precisa?
        $auth->addChild($adminBase, $adminTipoDados);//Precisa?
        
        //Arruma hierarquia
        
        echo "done.\nOrganizing the hierarchy... ";
        $auth->addChild($operadorColeta, $verProjeto);
        $auth->addChild($operadorUnidadeGeografica, $verProjeto);
        
        $auth->addChild($colaboradorProjeto, $operadorColeta);
        $auth->addChild($colaboradorProjeto, $operadorUnidadeGeografica);
        $auth->addChild($colaboradorProjeto, $operadorVisualizador);
        $auth->addChild($colaboradorProjeto, $operadorExportar);
        
        $auth->addChild($adminProjetoRole, $colaboradorProjeto);
        
        $auth->addChild($adminBase, $adminProjetoRole);
        $auth->addChild($adminBase, $curador);
        
        $this->actionSetpermicoes();
    }
    
    public function actionSetpermicoes()
    {
        echo "done.\nSetting permissions... ";
        $auth = \Yii::$app->authManager;
       
        $adminBase = $auth->getRole("adminBase");
        $adminProjetoRole = $auth->getRole("adminProjeto");
        $curador = $auth->getRole("curador");
        $colaboradorProjeto = $auth->getRole("colaboradorProjeto");
        $operadorColeta = $auth->getRole("operadorColeta");
        $operadorUnidadeGeografica = $auth->getRole("operadorUnidadeGeografica");
        
        
        foreach(\app\models\Pesquisador::find()->andWhere(["isAdminBase" =>1])->all() as $pesquisador)
        {
            $auth->assign($adminBase,$pesquisador->idPesquisador);
        }
        
        foreach(\app\models\Curadoria::find()->all() as $curadoria)
        {
            if (!$curadoria->idPesquisador0->hasRole($curador))
            {
                $auth->assign($curador, $curadoria->idPesquisador);
            }
        }
        
        foreach(\app\models\Projeto::find()->all() as $projeto)
        {
            if(!$projeto->idPesquisadorResponsavel0->hasRole($adminProjetoRole))
                $auth->assign($adminProjetoRole,$projeto->idPesquisadorResponsavel);
            foreach($projeto->idPesquisadores as $colaborador)
            {
                if(!$colaborador->hasRole($colaboradorProjeto))
                    $auth->assign($colaboradorProjeto,$colaborador->idPesquisador);
            }
            
            foreach($projeto->getViewPesquisadorPermissoes()->all() as $permissao)
            {
                if ($permissao->attributes["Administrar Coletas"])
                {
                    if (!$permissao->idPesquisador0->hasRole($operadorColeta))
                    {
                        $auth->assign($operadorColeta, $permissao->idPesquisador);
                    }
                }
                
                if ($permissao->attributes["Administrar Unidades Geográficas"])
                {
                    if (!$permissao->idPesquisador0->hasRole($operadorUnidadeGeografica))
                    {
                        $auth->assign($operadorUnidadeGeografica, $permissao->idPesquisador);
                    }
                }
            }
        }
        echo "done.\n";
    }
}
