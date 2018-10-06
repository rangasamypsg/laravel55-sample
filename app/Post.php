<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = "posts";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'user_id','title','body'
    ];

    //custom timestamps name
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }
    
}
