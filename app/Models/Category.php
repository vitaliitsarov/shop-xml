<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'parent_id', 
        'name'
    ];

    public function children()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }
}
