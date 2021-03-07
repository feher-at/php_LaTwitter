<?php


namespace App\Dao\Products;

use App\Http\Models\ProductModel;
use Illuminate\Support\Facades\DB;

class ProductsDaoImpl implements IProductsDao
{

    public function getProducts($limit, $offset){
        return  DB::select('Select * from products ORDER BY id LIMIT ? OFFSET ?',[$limit,$offset]);
    }

    public function countProducts(){
        return DB::select("SELECT COUNT(*) FROM products");
    }

    public function selectProductById($id){
        return ProductModel::find($id);
    }

    public function deleteProduct($id){
        DB::table('products')->where('id',$id)->delete();
    }

    public function searchProduct($searchValue,$limit,$offset){
        $sql = <<<SQL
        SELECT * FROM products  WHERE product_name ILIKE '%'||:pattern||'%' or product_description ILIKE '%'||:pattern||'%' order by id  LIMIT :limit OFFSET :offset
        SQL;
        return DB::select($sql, [
            "pattern"   => $searchValue,
            "limit"     => $limit,
            "offset"    => $offset
        ]);

    }
    public function checkIfProductExist($id)
    {
        $sql = <<< SQL
            select exists(select 1 from products where id= :id) as "exists"
SQL;
        return DB::select($sql,[
            "id" => $id
        ]);
    }

    public function countFilteredProducts($searchValue){

        $sql = <<<SQL
        SELECT count(*) FROM products  WHERE
                                product_name ILIKE '%'||:pattern||'%' OR
                                product_description ILIKE '%'||:pattern||'%'
SQL;
        return DB::select($sql, [
            "pattern"   => $searchValue
        ])[0];
    }
}
