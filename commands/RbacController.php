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
        
        $adminTipoDados = $auth->createPermission('adminTipoDados');
        $adminTipoDados->description = 'Administrar Tipos de dados';
        $auth->add($adminTipoDados);
        
        
        
        
        
        $deletarProjetoProprio = $auth->createPermission('deletarProjetoProprio');
        $deletarProjetoProprio->description = 'Deletar projeto';
        $auth->add($deletarProjetoProprio);
        
        
        
        
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
        
        
        
        
        $adminColetaProjeto = $auth->createPermission('adminColetaProjeto');
        $adminColetaProjeto->description = 'Administrar coletas do projeto';
        $auth->add($adminColetaProjeto);
        $auth->addChild($adminColetaProjeto,$admColetas);
        
        $adminUnidadeGeograficaProjeto = $auth->createPermission('adminUnidadeGeograficaProjeto');
        $adminUnidadeGeograficaProjeto->description = 'Administrar Uniidades Geográficas do projeto';
        $auth->add($adminUnidadeGeograficaProjeto);
        $auth->addChild($adminUnidadeGeograficaProjeto,$adminUnidadeGeografica);
        
        $verProjeto = $auth->createPermission('verProjeto');
        $verProjeto->description = 'Visualizar dados do projeto';
        $auth->add($verProjeto);
        
        $exportar = $auth->createPermission('exportar');
        $exportar->description = 'Exportação dados do projeto';
        $auth->add($exportar);
        
        
        
        
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
        
        
        
        
        // Cria todas "role" e hierarquia
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
        $auth->addChild($operadorColeta, $adminColetaProjeto);
        
        $auth->addChild($operadorUnidadeGeografica, $adminUnidadeGeograficaProjeto);
        
        $auth->addChild($operadorVisualizador, $verProjeto);
        
        $auth->addChild($operadorExportar, $exportar);
        
        $auth->addChild($colaboradorProjeto, $enviarConvites);
        $auth->addChild($colaboradorProjeto, $adicionarOperadores);
        $auth->addChild($colaboradorProjeto, $editarProjeto);
        $auth->addChild($colaboradorProjeto, $criarSubprojeto);
        
        $auth->addChild($adminProjetoRole, $deletarProjetoProprio);
        
        $auth->addChild($curador, $adminDescritores);
        $auth->addChild($curador, $adminOrganismo);
        $auth->addChild($curador, $adminMetodos);
        $auth->addChild($curador, $adminTaxonomia);
        
        $auth->addChild($adminBase, $adminProjeto);
        $auth->addChild($adminBase, $adminCuradoria);
        $auth->addChild($adminBase, $adminPesquisadores);
        $auth->addChild($adminBase, $admColetas);
        $auth->addChild($adminBase, $adminUnidadeGeografica);
        $auth->addChild($adminBase, $adminTipoDados);
        
        //Arruma hierarquia
        $auth->addChild($colaboradorProjeto, $operadorColeta);
        $auth->addChild($colaboradorProjeto, $operadorUnidadeGeografica);
        $auth->addChild($colaboradorProjeto, $operadorVisualizador);
        $auth->addChild($colaboradorProjeto, $operadorExportar);
        
        $auth->addChild($adminProjetoRole, $colaboradorProjeto);
        
        $auth->addChild($adminBase, $adminProjetoRole);
        $auth->addChild($adminBase, $curador);
    }
}
