<?php


namespace App\Dao\Orders;


use App\Http\Models\OrderItemsModel;
use Illuminate\Support\Facades\DB;

class OrderDaoImpl implements IOrderDao
{

    public function countOrders(){
        return DB::select("SELECT COUNT(*) FROM orders");
    }

public function countFilteredOrders($searchValue){

    $sql = <<<SQL
        SELECT count(*) FROM orders  WHERE
                                customer_name ILIKE '%'||:pattern||'%' OR
                                customer_email ILIKE '%'||:pattern||'%'
SQL;
    return DB::select($sql, [
        "pattern"   => $searchValue
    ])[0];
}

    public function getOrders($limit, $offset){
        return  DB::select('Select * from orders ORDER BY created_at DESC LIMIT ? OFFSET ? ',[$limit,$offset]);
    }

    public function searchOrder($searchValue,$limit,$offset){
        $sql = <<<SQL
        SELECT * FROM orders  WHERE customer_name ILIKE '%'||:pattern||'%' or customer_email ILIKE '%'||:pattern||'%' order by id  LIMIT :limit OFFSET :offset
        SQL;
        return DB::select($sql, [
            "pattern"   => $searchValue,
            "limit"     => $limit,
            "offset"    => $offset
        ]);
    }

    public function deleteOrder($id){
        DB::table('orders')->where('id',$id)->delete();
    }

    public function changeStatus(int $id, string $status){

        $order = OrderItemsModel::find($id);
        $order->status = $status;
        $order->save();
    }
}
