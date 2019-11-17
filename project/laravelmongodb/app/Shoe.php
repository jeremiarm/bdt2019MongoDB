<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Shoe extends Eloquent
{
    protected $connection = 'mongodb';
	protected $collection = 'shoesCollection';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CID', 'Category','SubCategory','HeelHeight','Insole','Closure','Gender','Material','ToeStyle'
    ];
    protected $guarded = ['_id'];
}
