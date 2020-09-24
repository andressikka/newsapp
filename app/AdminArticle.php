<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminArticle extends Model
{
    protected $fillable=['Title', 'Body'];


    public function revealNews()
    {
    	return $this->hasMany(AdminArticle::class);
    }
}
