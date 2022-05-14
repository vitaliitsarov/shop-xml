<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = "products";

    protected $fillable = [
        'title',
        'id_provider',
        'price_netto',
        'price_brutto',
        'stock',
        'status',
        'barcode',
        'original_url',
        'description'
    ];

    protected $casts = [
        'id_provider'       => 'integer',
        'status'            => 'boolean'
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }
}
