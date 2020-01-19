<?php
/**
 * Created by PhpStorm.
 * User: piavart
 * Date: 2020-01-18
 * Time: 17:32
 */

namespace App\Cron;

use App\Creators\NewsCreator;
use App\Models\News;

class NewsCronCreator
{
    public static function WeatherNews(){
        $sost = [
            'Облачно',
            'Снег',
            'Дождь',
            'Ясно',
            'Ураган',
        ];
        $data = [
            'title' => 'Погода на '. date('Y-m-d').' 9 утра',
            'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum',
            'type' => 1,
            'category' => 5,
            'temperature' => rand(-20,20),
            'pressure' => rand(180,200),
            'sost' => $sost[rand(0, count($sost)-1)]
        ];
        NewsCreator::CreateUpdate($data);
    }

    public static function ResultsDayNews(){

        $news = News::whereBetween( 'created_at', [
            date('Y-m-d'),
            date('Y-m-d').' 23:59:59'
        ] )->where('type_id', 2)->get();

        $links = $news->map( function ( News $value ){
            return [
                'title' => $value->title,
                'id' => $value->id
            ];
        });

        $data = [
            'title' => 'Итоги дня '. date('Y-m-d'),
            'content' => 'Главные новости за этот день',
            'type' => 4,
            'category' => 6,
            'count' => count($news),
            'links' => $links
        ];
        NewsCreator::CreateUpdate($data);
    }
}