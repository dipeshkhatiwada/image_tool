<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageComment extends Model
{
    use HasFactory;
    protected  $table = 'image_comments';
    protected $fillable = [ 'image_id', 'message', 'added_by'];
    function  image()
    {
        return $this->belongsTo(Image::class,'image_id');
    }
    function  addedBy()
    {
        return $this->belongsTo(User::class,'added_by');
    }


}
