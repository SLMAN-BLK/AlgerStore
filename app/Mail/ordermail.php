<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    
    public function __construct($order)
    {
        $this->order = $order;
    }

    
    public function build()
    {
        return $this->view('email.order')
                    ->with([
                        'order' => $this->order,
                    ])
                    ->subject('The Object');
    }
}
