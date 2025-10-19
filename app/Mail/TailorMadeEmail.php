<?php

namespace App\Mail;

use App\Models\Contact;
use App\Models\TailorMade;
use App\Models\TourReservation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class TailorMadeEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $tailorMade;
    public function __construct(TailorMade $tailorMade)
    {
        $this->tailorMade = $tailorMade;
    }
    public function build()
    {
        return $this->subject(nova_get_setting('site_name', env('APP_NAME')).'#'.$this->tailorMade->id)
            ->view('mails.tailorMade')
            ->from(Config::get('mail.from.address'), Config::get('mail.from.name'))
            ->with([
                'tailorMade' => $this->tailorMade
            ]);
    }
}
