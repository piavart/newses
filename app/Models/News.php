<?php
/**
 * Created by PhpStorm.
 * User: piavart
 * Date: 2020-01-16
 * Time: 21:44
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class News
 * @package App\Models
 * @property integer $id
 * @property integer $type_id
 * @property integer $category_id
 * @property string $title
 * @property $content
 * @property array $extend
 */
class News extends Model
{
    use SoftDeletes;

    public const __EXTEND_FIELDS__ = [
        'dop',
        'temperature',
        'pressure',
        'sost',
        'count',
        'links'
    ];

    protected $casts = [
        'extend' => 'array'
    ];


    // ОБРАТНАЯ СВЯЗЬ К КАТЕГОРИИ
    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    // ОБРАТНАЯ СВЯЗЬ К ТИПУ
    public function type(){
        return $this->belongsTo('App\Models\NewsType');
    }
}