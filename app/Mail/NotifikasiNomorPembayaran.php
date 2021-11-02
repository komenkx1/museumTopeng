<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifikasiNomorPembayaran extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($currentTransaction,$transactionInfos)
    {
        $this->currentTransaction = $currentTransaction;
        $this->transactionInfos = $transactionInfos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // dd($this->transactionInfos); 
        return $this->markdown('notifikasiNomorPembayaran')
                    ->subject("Transaksi #".$this->currentTransaction->session_ID)
                    ->with(["transaction" => $this->currentTransaction, "transactionInfos"=>$this->transactionInfos]);
    }
}
