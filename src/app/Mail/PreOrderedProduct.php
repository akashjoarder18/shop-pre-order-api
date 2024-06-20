<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PreOrderedProduct extends Mailable
{
    use Queueable, SerializesModels;

    
    public $order;
    /**
     * Create a new message instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->view('emails.preorder')
                    ->with([
                        'userName' => $this->order->name,
                    ]);
    }
}

