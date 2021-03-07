<?php


namespace App\Services;

use App\Http\Models\OrderItemsModel;
use App\Mail\OrderEmail;
use App\Services\Interfaces\IEmailService;
use Illuminate\Support\Facades\Mail;

class EmailServiceImpl implements IEmailService
{

    public function sendEmailFromOrder(OrderItemsModel $orderModel)
    {
        Mail::to('phptestuser01@gmail.com')
            ->send(new OrderEmail($orderModel));
    }

}
