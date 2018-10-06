<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    public $table = "profiles";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
        'user_id','phone','address'
    ];

    //custom timestamps name
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    
    public function user() {
        return $this->belongsTo(User::class);
    }

    
}
