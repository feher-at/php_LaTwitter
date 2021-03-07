<?php


namespace App\Dao\Orders;


interface IOrderDao
{
    public function countOrders();
    public function countFilteredOrders($searchValue);
    public function getOrders($limit, $offset);
    public function searchOrder($searchValue,$limit,$offset);
    public function deleteOrder($id);
    public function changeStatus(int $id, string $status);
}
