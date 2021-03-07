<?php


namespace App\Services\Interfaces;


use Illuminate\Http\Request;


interface IOrderService
{
    public function countOrders($request);
    public function getOrders($request);
    public function deleteOrder($request);
    public function changeStatus($request);
    public function createNewOrder(Request $data);
    public function validation($request);
    public function createOrderInfo(Request $data);

}
