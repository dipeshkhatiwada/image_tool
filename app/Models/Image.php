<?php

namespace App\Models;

use Coderflex\Laravisit\Concerns\CanVisit;
use Coderflex\Laravisit\Concerns\HasVisits;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model implements CanVisit
{
    use HasFactory, HasVisits;
    protected  $table = 'images';

    protected $fillable = ['title', 'description', 'value', 'image', 'views', 'owner_id'];

    function  owner()
    {
        return $this->belongsTo(User::class,'owner_id');
    }


}
