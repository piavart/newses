<?php
/**
 * Created by PhpStorm.
 * User: piavart
 * Date: 2020-01-16
 * Time: 21:48
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public $timestamps = false; // У данных типов записи не содержатся поля created_at и updated_at

    // список новостей категории
    public function news(){
        return $this->hasMany('App\Models\News');
    }
}