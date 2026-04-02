<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Order;

class Orderplacedmail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build(){

        $pdf = Pdf::loadview('orders.invoice',['order'=>$this->order]);

        return $this->subject('order confirmation')->markdown('emails.order')->attachData($pdf->output(), "invoice.pdf",[
                'mime' => 'application/pdf'
            ]);
    }

}
