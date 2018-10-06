<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = "categories";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'slug','category'
    ];

    //custom timestamps name
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function posts() {
        return $this->belongsToMany(Post::class);
    }
}
