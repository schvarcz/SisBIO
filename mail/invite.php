<?php

use yii\helpers\Url;
?>

Olá <?= $model->label ?>,<br/><br/>

Você foi convidado a ingressar a rede SisBIO de coleta de dados.

<br/>
Para criar seu login, acesse o link: <?= Url::to(["site/active", "authKey" => $model->authKey]); ?>
<br/><br/>
Att.
