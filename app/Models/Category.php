<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function primaryCategory()
    {
        return $this->belongsTo(PrimaryCategory::class, 'primary_category_id');
    }
}
