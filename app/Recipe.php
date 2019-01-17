<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['title','procedure'];

    /**
     * The owner of this delicious recipe
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function publisher(){
        return $this->belongsTo(User::class,'publisher_id');
    }
}
