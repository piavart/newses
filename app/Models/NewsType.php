<?php
/**
 * Created by PhpStorm.
 * User: piavart
 * Date: 2020-01-18
 * Time: 13:29
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class NewsType extends Model
{

    public $timestamps = false; // У данных типов записи не содержатся поля created_at и updated_at

    // список новостей по типу
    public function news(){
        return $this->hasMany('App\Models\News','type_id');
    }
}