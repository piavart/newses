<?php
/**
 * Created by PhpStorm.
 * User: piavart
 * Date: 2020-01-18
 * Time: 13:46
 */

namespace App\Creators;


use App\Models\News;

class NewsCreator
{
    public static function CreateUpdate( array $data, $id = false ) : News
    {
        if($id && $news = News::find($id)){
            $extend = $news->extend;
        }
        else{
            $news = new News();
            $extend = [];
        }
        $news->type_id = $data['type'];
        $news->category_id = $data['category'];
        $news->title = $data['title'];
        $news->content = $data['content'];
        foreach ($data as $key => $value){
            in_array($key,News::__EXTEND_FIELDS__) ? $extend[$key] = $value : true;
        }
        $news->extend = $extend;
        $news->save();
        return $news;
    }
}