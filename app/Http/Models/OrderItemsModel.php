<?php

namespace App\Http\Models;

use DateTimeImmutable;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id;
 * @property int $product_id;
 * @property int $product_price_at_order;
 * @property string $product_description;
 * @property string $costumer_name;
 * @property string $costumer_shipping_address;
 * @property string $costumer_billing_address;
 * @property string $costumer_email;
 * @property int $product_quantity;
 * @property int $final_price;
 * @property DateTimeImmutable created_at;
 * @property DateTimeImmutable updated_at;
 * Class ProductModel
 * @package App\Http\Models
 */
class OrderItemsModel extends Model
{
    protected $fillable = [
        'product_id',
        'product_name',
        'product_price_at_order',
        'customer_name',
        'customer_shipping_address',
        'customer_billing_address',
        'customer_email',
        'product_quantity',
        'final_price',
    ];

        protected $table = 'orders';
}

