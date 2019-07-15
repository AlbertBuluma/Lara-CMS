<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'category_id', 'title','description','content','image','published_at'   //Permit mass assignment on Post model
    ];


//    Delete post image from storage
//      Return void
    public function deleteImage(){

        Storage::delete($this->image);
    }

    public function category(){

        return $this->belongsTo(Category::class);   //Post model belongs to Category model
    }
}
