<?php
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'SisBIO';
$this->registerJsFile(Yii::$app->homeUrl . "js/parallax.min.js", [ "depends" => ['yii\web\JqueryAsset']]);
$this->registerJsFile(Yii::$app->homeUrl . "js/welcome.js", [ "depends" => ['yii\web\JqueryAsset']]);
?>

<div id="home" class="parallax-window window-height" data-parallax="scroll" data-image-src="<?= Url::base() ?>/images/cover.jpg">
    <!--    
        <div style="position:fixed; top:0px; right:0px; left: 0px;height:300px;">
            
            <div style="position:fixed; top:0px; right:0px; left: 0px;opacity: 0.7;background: #fff;height:100%"></div>
            <a class="loginWelcome" href="<?= \yii\helpers\Url::to("site/login") ?>"> Login </a>
            <div class="jumbotron">
                <h1>SisBIO</h1>
            </div>
        </div>-->

</div>

<div id="sobre" class="content window-height">
    <div class="container">
        <div class="site-index">
            <div class="body-content">
                <h1>Sobre</h1>
                <p class="lead">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vel tempor purus. Fusce dictum augue a nunc finibus ornare. Aenean finibus pharetra tincidunt. Vivamus varius ipsum diam. Quisque a justo in neque semper aliquam eget quis ligula. Donec in scelerisque nibh, in aliquet mi. Cras facilisis sed lectus quis tincidunt.

                    Nam orci nulla, rutrum in quam sed, aliquam finibus velit. Praesent quam nibh, rutrum congue egestas nec, pretium non risus. Nunc euismod, erat ac congue suscipit, sem ipsum condimentum tortor, vitae eleifend neque orci at magna. Cras vel vulputate lectus. Curabitur congue elit non pharetra molestie. Mauris aliquam mi turpis, in ultrices urna elementum ut. Vivamus sed dui a odio blandit iaculis. In libero massa, gravida ornare fringilla rutrum, rutrum sit amet dui. Pellentesque tincidunt cursus nibh eget sollicitudin. Etiam euismod tincidunt facilisis.
                </p>
            </div>
        </div>
    </div>
</div>
<div class="parallax-window window-height" data-parallax="scroll" data-position-x="left" data-image-src="<?= Url::base() ?>/images/cover2.jpg"> 
    <blockquote class="blockquote-reverse" style="background: rgba(255,255,255,0.7); padding-left:10px;position:absolute; right:70px;bottom:60px;">
        <p>Biology is the study of complicated things that have the appearance of having been designed with a purpose.</p>
        <footer>Richard Dawkins</footer>
    </blockquote>
</div>
<div id="projetos" class="content window-height">
    <div class="container">
        <h1>Projetos</h1>
        <div class="col-lg-4">
            <img src="<?= Url::base() ?>/images/tartaruga.jpg" alt="..." width="70%" class="img-circle img-thumbnail img-responsive center-block">
            <h2>SisBiota</h2>

            <div class="lead presentation-1">
                <p>O objetivo do Sistema Nacional de Pesquisa é fomentar e ampliar o conhecimento da biodiversidade brasileira, melhorar a capacidade preditiva de respostas a mudanças globais, particularmente às mudanças de uso e cobertura da terra e mudanças climáticas; associando as pesquisas à formação de recursos humanos, educação ambiental e divulgação do conhecimento científico. Entre os eixos temáticos do programa estão: </p>
                <ul>
                    <li>Ampliação do conhecimento da biodiversidade; </li>
                    <li>Padrões e processos relacionados à biodiversidade; </li>
                    <li>Monitoramento da biodiversidade; </li>
                    <li>Desenvolvimento de bioprodutos e usos da biodiversidade.</li>
                </ul>
            </div>

            <p><a class="btn btn-default" href="http://www.cnpq.br/web/guest/apresentacao11;jsessionid=87B23F8777BF4A3943EF46E16F33DE43" target="_new">Leia mais &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <img src="<?= Url::base() ?>/images/gado.jpg" alt="..." width="70%" class="img-circle img-thumbnail img-responsive center-block">
            <h2>PELD</h2>

            <p class="lead presentation-1">
                O Programa de Pesquisa Ecológica de Longa Duração (PELD) representa uma iniciativa pioneira e uma visão estratégica do Governo Federal, ao articular, desde 1999, uma rede de sítios de referência para a pesquisa científica no tema de Ecologia de Ecossistemas. Através do PELD, o CNPq fomenta a geração de conhecimento qualificado sobre os nossos ecossistemas e a biodiversidade que abrigam. O PELD estimula ainda a transferência do conhecimento gerado para a sociedade civil, visando contribuir para o desenvolvimento ambientalmente sustentável de nosso país.
            </p>

            <p><a class="btn btn-default" href="http://www.cnpq.br/web/guest/apresentacao7" target="_new">Leia mais &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <img src="<?= Url::base() ?>/images/planta.jpg" alt="..." width="70%" class="img-circle img-thumbnail img-responsive center-block">
            <h2>PPBio</h2>

            <p class="lead presentation-1"> O Programa de Pesquisa em Biodiversidade PPBio foi criado pelo MCT em junho de 2004 e está consonância com os princípios da Convenção sobre Diversidade Biológica e com as Diretrizes da Política Nacional de Biodiversidade. De abrangência nacional, o Programa em sua fase inicial impulsionará as atividades na Amazônia Oriental - Museu Paraense Emílio Goeldi, na Amazônia Ocidental - Instituto Nacional de Pesquisas da Amazônia e no Semi-árido - Universidade Federal de Feira de Santana. O objetivo central do PPBio é articular a competência regional e nacional para que o conhecimento da biodiversidade brasileira seja ampliado e disseminado de forma planejada e coordenada. O CNPq participa deste Programa como membro do Comitê Científico, além de operacionalizar a implementação dos auxílios a pesquisa e bolsas. Auxilia também no acompanhamento e avaliação do desempenho dos projetos juntamente com o Núcleo Coordenador do PPBio.</p>

            <p><a class="btn btn-default" href="http://www.cnpq.br/web/guest/ppbio" target="_new">Leia mais &raquo;</a></p>
        </div>
    </div>
</div>

<div class="parallax-window window-height" style="position:relative" data-parallax="scroll" data-image-src="<?= Url::base() ?>/images/cover3.jpg"> 

    <blockquote class="blockquote" style="background: rgba(255,255,255,0.7); padding-left:10px;position:absolute; left:70px;bottom:60px;">
        <p>When you have seen one ant, one bird, one tree, you have not seen them all.</p>
        <footer>E. O. Wilson</footer>
    </blockquote>
</div>


<div id="contato" class="content window-height">
    <div class="container">
        <div class="site-index">
            <div class="body-content">
                <h1>Contato</h1>
                <br/>
                <br/>
                <h3>Emails </h3>
                <p class="lead">
                Valerio Pillar - <a href="mailto:vpillar@ufrgs.br">vpillar@ufrgs.br</a> <br/>
                Eduardo Velez - <a href="mailto:velezedu@portoweb.com.br">velezedu@portoweb.com.br</a> <br/>
                Guilherme Schvarcz Franco - <a href="mailto:guilhermefrancosi@gmail.com">guilhermefrancosi@gmail.com</a> <br/>
                </p>
                <br/>
                
                <h3>Telefones </h3>
                <p class="lead">
                Telefone: <a href="tel:+555133087101">(51) 33087101</a><br/>
                Fax: <a href="tel:+555133087626">(51) 33087626</a><br/>
                </p>
                <br/>
                
                <h3>Endereço </h3>
                <p class="lead">
                Universidade Federal do Rio Grande do Sul, Instituto de Biociências, Centro de Ecologia. <br/>
                Av. Bento Gonçalves, 9500 <br/>
                Agronomia<br/>
                91540-000 - Porto Alegre, RS - Brasil - Caixa-postal: 15007<br/>
                </p>
            </div>
        </div>
    </div>
</div>