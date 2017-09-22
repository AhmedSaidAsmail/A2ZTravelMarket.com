<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class resetEmail extends Mailable {

    use Queueable,
        SerializesModels;

    public $sending_mail;
    public $email;
    public $token;
    public $subject;
    public $session_time;

    public function __construct($email, $token, $subject, $sending_mail) {
        $this->email = $email;
        $this->token = $token;
        $this->subject = $subject;
        $this->sending_mail = $sending_mail;
        $this->session_time= time();
    }

    public function build() {
        return $this->subject($this->subject)
                        ->from($this->email, $this->subject)
                        ->view('mail.customer_reset_mail')
                        ->with([
                            'sending_to' => $this->sending_mail,
                            'token' => $this->token,
                            'session_time'=> $this->session_time]);
    }

}
