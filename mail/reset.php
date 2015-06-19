<?php

use yii\helpers\Url;

?>

Olá <?= $model->label ?>,<br/><br/>

Você está recebendo esse email, pois uma solicitação para resetar a sua senha foi feita para a sua conta. 

<br/>
Para resetar a sua senha, por favorm, acesse o link: <?= Url::to(["site/reset","authKey" => $model->authKey]); ?>
<br/><br/>
Att.
