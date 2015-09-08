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

class MailSenderCronController extends Controller
{

    public function actionIndex()
    {
        $sender = "email@email.com";
        echo "Running cron\n";

        echo "Inviting\n";
        $pesquisadores = Pesquisador::findAll(["idCronTask" => 1]);
        foreach ($pesquisadores as $pesquisador)
        {
            echo $pesquisador->getLabel();
            Yii::$app->mailer->compose("invite", ["model" => $pesquisador])
                    ->setFrom($sender)
                    ->setTo($pesquisador->email)
                    ->setSubject('[SisBIO - ECOQUA] Convite ao pesquisador.')
                    ->send();
            $pesquisador->idCronTask = NULL;
            $pesquisador->save();
        }


        echo "\n\nReseting password\n";
        $pesquisadores = Pesquisador::findAll(["idCronTask" => 2]);
        foreach ($pesquisadores as $pesquisador)
        {
            echo $pesquisador->getLabel();
            $sent = Yii::$app->mailer->compose("reset", ["model" => $pesquisador])
                    ->setFrom($sender)
                    ->setTo($pesquisador->email)
                    ->setSubject('[SisBIO - ECOQUA] Recuperação de senha.')
                    ->send();
            if($sent)
            {
                $pesquisador->idCronTask = NULL;
                $pesquisador->save();
            }
        }
    }

}
