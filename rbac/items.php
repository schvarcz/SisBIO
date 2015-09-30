<?php
return [
    'adminDescritores' => [
        'type' => 2,
        'description' => 'Administrar descritores',
    ],
    'adminOrganismo' => [
        'type' => 2,
        'description' => 'Administrar Tipos de Organismo',
    ],
    'adminMetodos' => [
        'type' => 2,
        'description' => 'Administrar Métodos de Coleta',
    ],
    'adminTaxonomia' => [
        'type' => 2,
        'description' => 'Administrar Taxonomia',
    ],
    'adminColetaProjeto' => [
        'type' => 2,
        'description' => 'Administrar coletas do projeto',
    ],
    'adminUnidadeGeograficaProjeto' => [
        'type' => 2,
        'description' => 'Administrar Uniidades Geográficas do projeto',
    ],
    'verProjeto' => [
        'type' => 2,
        'description' => 'Visualizar dados do projeto',
    ],
    'exportar' => [
        'type' => 2,
        'description' => 'Exportação dados do projeto',
    ],
    'enviarConvites' => [
        'type' => 2,
        'description' => 'Convidar novas pessoas ao sistema',
    ],
    'adicionarOperadores' => [
        'type' => 2,
        'description' => 'Atribuir funções de operador da base',
    ],
    'editarProjeto' => [
        'type' => 2,
        'description' => 'Editar projeto',
    ],
    'criarSubprojeto' => [
        'type' => 2,
        'description' => 'Criar subprojetos',
    ],
    'deletarProjetoProprio' => [
        'type' => 2,
        'description' => 'Deletar projeto',
    ],
    'adminProjetos' => [
        'type' => 2,
        'description' => 'Administrador de todos projetos',
    ],
    'adminCuradoria' => [
        'type' => 2,
        'description' => 'Administrador de todas curadorias',
    ],
    'adminPesquisadores' => [
        'type' => 2,
        'description' => 'Administrador de todos pesquisadores',
    ],
    'admColetas' => [
        'type' => 2,
        'description' => 'Administrador de todas coletas',
    ],
    'adminUnidadeGeografica' => [
        'type' => 2,
        'description' => 'Administrador de todas Unidades Geográficas',
    ],
    'operador' => [
        'type' => 1,
        'description' => 'Operador da base',
        'children' => [
            'adminColetaProjeto',
            'adminUnidadeGeograficaProjeto',
            'verProjeto',
            'exportar',
        ],
    ],
    'colaboradorProjeto' => [
        'type' => 1,
        'description' => 'Pesquisador Colaborador do projeto',
        'children' => [
            'operador',
            'enviarConvites',
            'adicionarOperadores',
            'editarProjeto',
            'criarSubprojeto',
        ],
    ],
    'adminProjeto' => [
        'type' => 1,
        'description' => 'Administrador de projeto',
        'children' => [
            'colaboradorProjeto',
            'deletarProjetoProprio',
        ],
    ],
    'curador' => [
        'type' => 1,
        'description' => 'Curador de Grupo Biologico',
    ],
    'adminBase' => [
        'type' => 1,
        'description' => 'Administrador da Base',
        'children' => [
            'adminProjeto',
            'curador',
            'adminProjetos',
            'adminCuradoria',
            'adminPesquisadores',
            'admColetas',
            'adminUnidadeGeografica',
        ],
    ],
];
