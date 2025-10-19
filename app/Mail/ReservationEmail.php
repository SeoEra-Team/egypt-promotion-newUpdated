<?php

namespace App\Mail;


use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class ReservationEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $reservation;
    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }
    public function build()
    {
        return $this->subject(nova_get_setting('site_name', env('APP_NAME')).'#'.$this->reservation->id)
            ->view('mails.reservation')
            ->from(Config::get('mail.from.address'), Config::get('mail.from.name'))
            ->with([
                'reservation' => $this->reservation
            ]);
    }
}
