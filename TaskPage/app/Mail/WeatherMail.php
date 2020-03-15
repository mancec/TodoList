<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeatherMail extends Mailable
{
    use Queueable, SerializesModels;

    public $wind;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($var)
    {
        $this->wind = $var;
    }

    public function build()
    {
        return $this->markdown('emails.wind');
    }
}
