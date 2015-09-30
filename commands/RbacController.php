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
        $auth->removeAll();

        
        //Cria permissões
        $adminDescritores = $auth->createPermission('adminDescritores');
        $adminDescritores->description = 'Administrar descritores';
        $auth->add($adminDescritores);
        
        $adminOrganismo = $auth->createPermission('adminOrganismo');
        $adminOrganismo->description = 'Administrar Tipos de Organismo';
        $auth->add($adminOrganismo);
        
        $adminMetodos = $auth->createPermission('adminMetodos');
        $adminMetodos->description = 'Administrar Métodos de Coleta';
        $auth->add($adminMetodos);
        
        $adminTaxonomia = $auth->createPermission('adminTaxonomia');
        $adminTaxonomia->description = 'Administrar Taxonomia';
        $auth->add($adminTaxonomia);
        
        
        
        
        
        $adminColetaProjeto = $auth->createPermission('adminColetaProjeto');
        $adminColetaProjeto->description = 'Administrar coletas do projeto';
        $auth->add($adminColetaProjeto);
        
        $adminUnidadeGeograficaProjeto = $auth->createPermission('adminUnidadeGeograficaProjeto');
        $adminUnidadeGeograficaProjeto->description = 'Administrar Uniidades Geográficas do projeto';
        $auth->add($adminUnidadeGeograficaProjeto);
        
        $verProjeto = $auth->createPermission('verProjeto');
        $verProjeto->description = 'Visualizar dados do projeto';
        $auth->add($verProjeto);
        
        $exportar = $auth->createPermission('exportar');
        $exportar->description = 'Exportação dados do projeto';
        $auth->add($exportar);
        
        
        
        
        $enviarConvites = $auth->createPermission('enviarConvites');
        $enviarConvites->description = 'Convidar novas pessoas ao sistema';
        $auth->add($enviarConvites);
        
        $adicionarOperadores = $auth->createPermission('adicionarOperadores');
        $adicionarOperadores->description = 'Atribuir funções de operador da base';
        $auth->add($adicionarOperadores);
        
        $editarProjeto = $auth->createPermission('editarProjeto');
        $editarProjeto->description = 'Editar projeto';
        $auth->add($editarProjeto);
        
        $criarSubprojeto = $auth->createPermission('criarSubprojeto');
        $criarSubprojeto->description = 'Criar subprojetos';
        $auth->add($criarSubprojeto);
        
        
        
        
        $deletarProjetoProprio = $auth->createPermission('deletarProjetoProprio');
        $deletarProjetoProprio->description = 'Deletar projeto';
        $auth->add($deletarProjetoProprio);
        
        
        
        
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
        
        $adminUnidadeGeografica = $auth->createPermission('adminUnidadeGeografica');
        $adminUnidadeGeografica->description = 'Administrador de todas Unidades Geográficas';
        $auth->add($adminUnidadeGeografica);
        
        
        
        
        // Cria todas "role" e hierarquia
        $operador = $auth->createRole('operador');
        $operador->description = "Operador da base";
        $auth->add($operador);
        
        $colaboradorProjeto = $auth->createRole('colaboradorProjeto');
        $colaboradorProjeto->description = "Pesquisador Colaborador do projeto";
        $auth->add($colaboradorProjeto);
        $auth->addChild($colaboradorProjeto, $operador);
        
        $adminProjetoRole = $auth->createRole('adminProjeto');
        $adminProjetoRole->description = "Administrador de projeto";
        $auth->add($adminProjetoRole);
        $auth->addChild($adminProjetoRole, $colaboradorProjeto);
        
        $curador = $auth->createRole('curador');
        $curador->description = "Curador de Grupo Biologico";
        $auth->add($curador);
        
        $adminBase = $auth->createRole('adminBase');
        $adminBase->description = "Administrador da Base";
        $auth->add($adminBase);
        $auth->addChild($adminBase, $adminProjetoRole);
        $auth->addChild($adminBase, $curador);
        
        
        
        //Atribui permissoes
        $auth->addChild($operador, $adminColetaProjeto);
        $auth->addChild($operador, $adminUnidadeGeograficaProjeto);
        $auth->addChild($operador, $verProjeto);
        $auth->addChild($operador, $exportar);
        
        $auth->addChild($colaboradorProjeto, $enviarConvites);
        $auth->addChild($colaboradorProjeto, $adicionarOperadores);
        $auth->addChild($colaboradorProjeto, $editarProjeto);
        $auth->addChild($colaboradorProjeto, $criarSubprojeto);
        
        $auth->addChild($adminProjetoRole, $deletarProjetoProprio);
        
        $auth->addChild($adminBase, $adminProjeto);
        $auth->addChild($adminBase, $adminCuradoria);
        $auth->addChild($adminBase, $adminPesquisadores);
        $auth->addChild($adminBase, $admColetas);
        $auth->addChild($adminBase, $adminUnidadeGeografica);
        
        $auth->assign($adminBase,1);
        
    }
}
