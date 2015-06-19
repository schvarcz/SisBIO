<?php

/**
 * Description of MailSenderCronController
 *
 * @author schvarcz
 */

namespace app\commands;

use Yii;
use yii\console\Controller;
use app\models\Pesquisador;

class MailSenderCronController extends Controller {

    public function actionIndex() {
        echo "Running cron\n";

        echo "Inviting\n";
        $pesquisadores = Pesquisador::findAll(["idCronTask" =>1]);
        foreach ($pesquisadores as $pesquisador) {
            Yii::$app->mailer->compose("invite", ["model" => $pesquisador])
                    ->setFrom('guilhermefrancosi@gmail.com')
                    ->setTo('guilhermefrancosi@gmail.com')
                    ->setSubject('Message subject')
                    ->setTextBody('Plain text content')
                    ->send();
            $pesquisador->idCronTask = NULL;
            $pesquisador->save();
        }
        
        
        echo "\n\nReseting password\n";
        $pesquisadores = Pesquisador::findAll(["idCronTask" =>2]);
        foreach ($pesquisadores as $pesquisador) {
            Yii::$app->mailer->compose("reset", ["model" => $pesquisador])
                    ->setFrom('guilhermefrancosi@gmail.com')
                    ->setTo('guilhermefrancosi@gmail.com')
                    ->setSubject('Message subject')
                    ->setTextBody('Plain text content')
                    ->send();
            $pesquisador->idCronTask = NULL;
            $pesquisador->save();
        }
    }

}
