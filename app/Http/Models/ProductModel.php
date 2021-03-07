<?php

namespace App\Http\Models;

use DateTimeImmutable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id;
 * @property string $product_name;
 * @property int $product_price;
 * @property int $product_sale_price;
 * @property string $product_description;
 * @property DateTimeImmutable created_at;
 * @property DateTimeImmutable updated_at;
 * Class ProductModel
 * @package App\Http\Models
 */
class ProductModel extends Model
{
        protected $fillable = [
            'product_name',
            'product_price',
            'product_sale_price',
            'product_description',
        ];
        protected $table = 'products';

        public function finalPrice(){
            if ($this->product_sale_price !== null && $this->product_sale_price < $this->product_price) {
                return $this->product_sale_price;
            }

            return $this->product_price;
        }
}
