<?php


namespace App\Services\Interfaces;

use App\Http\Models\OrderItemsModel;

interface IEmailService
{

    public function sendEmailFromOrder(OrderItemsModel $orderModel);
}
