<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminReservationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected Reservation $reservation;
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }
    public function build()
    {
        return $this->view('mails.mail-admin')->subject(__('mail.order_admin_mail_subject'))->with([
            'reservation' => $this->reservation
        ]);
    }
}
