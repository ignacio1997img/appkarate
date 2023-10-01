<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $fillable = ['dojo_id', 'type_id', 'ci', 'first_name', 'last_name', 'age', 'weight', 'description', 'status', 'deleted_at'];

    public function dojo()
    {
        return $this->belongsTo(Dojo::class, 'dojo_id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }
}
