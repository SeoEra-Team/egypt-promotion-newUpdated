<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;
    private $contact;
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }
    public function build()
    {
        return $this->subject(nova_get_setting('site_name', env('APP_NAME')).'#'.$this->contact->id)
            ->view('mails.contact')
            ->from(Config::get('mail.from.address'), Config::get('mail.from.name'))
            ->with([
                'contact' => $this->contact
            ]);
    }
}
