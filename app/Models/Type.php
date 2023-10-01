<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['type_id', 'description', 'tournament_id', 'deleted_at'];


    public function tournament()
    {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }
    public function type()
    {
        return $this->belongsTo(TournamentsCategory::class, 'type_id');
    }


}
