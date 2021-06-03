<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class forget_password extends Mailable
{
    use Queueable, SerializesModels;

   public $data;

    public function __construct($data)
    {
        $this->data=$data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.user.forgetPassword')
            ->to($this->data['email'],$this->data['name'])
            ->subject('Password Reset Instruction');
    }
}
