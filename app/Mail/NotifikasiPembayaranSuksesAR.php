<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifikasiPembayaranSuksesAR extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($transaction,$arAccount,$password)
    {
        $this->transaction = $transaction;
        $this->arAccount = $arAccount;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('notifikasiPembayaranSuksesAR')
                    ->subject("Success Transaction #".$this->transaction->session_ID)
                    ->with(["transaction" => $this->transaction, "account"=>$this->arAccount,"password"=>$this->password]);
    }
}
