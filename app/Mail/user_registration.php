<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class user_registration extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $data;

    public function __construct($data)
    {
        $this->data=$data;
    }

    /**da
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.user.register')
            ->to($this->data['email'],$this->data['name'])
            ->subject('User Registration Detail');
    }
}
