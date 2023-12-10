<?php namespace Adminlte3\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model {

    protected $table = 'orders';

    protected $guarded = ['id'];

    const UPLOAD_PATH = '/public/uploads/orders/';
    const UPLOAD_URL  = '/uploads/orders/';

    public function products() {
        return $this->belongsToMany(Product::class)
            ->withPivot(['qnt', 'price']);
    }

    public function dateFormat($format = 'd.m.Y')
    {
        if (!$this->created_at) return null;
        return date($format, strtotime($this->created_at));
    }

    public function delivery_item() {
        return $this->belongsTo(DeliveryItem::class);
    }

    public function scopeNewOrder($query) {
        return $query->whereNew(1);
    }

}
