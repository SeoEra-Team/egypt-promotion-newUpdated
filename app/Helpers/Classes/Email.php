<?php

namespace App\Helpers\Classes;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Email
{
    /**
     * @param Model $model
     * @param string $msg
     * @param array $receiversMails
     * @param string $subject
     * @return void
     */
    public static function send(Model $model,
                                string $msg,
                                array $receiversMails = [],
                                string $subject = 'Request From Best Destination Tours'): void
    {
        $data = array('model' => $model, 'msg' => $msg);
        Mail::send('mails.forms', $data, function($message) use ($model, $subject, $receiversMails) {
            $receiversMails[] = $model->email;

            $message->to($receiversMails, $model->name)->subject($subject);
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
        });

    }

    /**
     * @param $model
     * @return array
     */
    public static function getReceiversMails($model)
    {
        $mails = json_decode(nova_get_setting($model.'_mails'));

        if(isset($mails) && count($mails)) {
            return array_map(function ($mail) {
                return $mail->mails;
            }, $mails);
        }

        return [];
    }
}
