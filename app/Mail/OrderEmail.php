<?php

namespace App\Mail;

use App\Http\Models\OrderItemsModel;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    /** @var OrderItemsModel $order

     */
    private OrderItemsModel $order;

    /**
     * Create a new message instance.
     * @param OrderItemsModel $order
     * @return void
     */
    public function __construct(OrderItemsModel $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $mailSubject = 'Thank you for your order';

        $this ->from('lawebshop@gmail.com')
              ->subject($mailSubject)
              ->view('mail.orderMail',['order'=>$this->order,
                                            'title' => $mailSubject]);
        return $this;
    }
}
