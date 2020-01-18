<?php
/**
 * Created by PhpStorm.
 * User: piavart
 * Date: 2020-01-16
 * Time: 21:42
 */

namespace App\Http\Controllers;



use App\Creators\NewsCreator;
use App\Http\Requests\StoreNewsPost;
use App\Models\Category;
use App\Models\News;
use App\Models\NewsType;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function Index(){
        $categories = Category::all();
        return View( 'news',compact('categories') );
    }

    public function IndexPost( Request $request ){

        $news = News::whereBetween( 'created_at', [
            $request->start,
            $request->end.' 23:59:59'
        ] );

        if($request->category !== 'all' ){
            $news = $news->where('category_id', $request->category);
        }

        $news = $news->orderByDesc('id')->with('category','type')->get();
        return response()->json(compact('news'));
    }

    public function CreateForm(){
        $categories = Category::find([1,2,3,4]);
        $types = NewsType::find([2,3]);
        return view('create', compact('categories','types'));
    }

    public function CreateNewsPost( StoreNewsPost $request ){
        NewsCreator::CreateUpdate($request->all());
        return response()->json(['result' => 'ok']);
    }

    public function GetSingleNews( $id ){
        $news = News::whereId( $id )->with('category','type')->first();
        return View( 'single_news',compact('news') );
    }

    public function GetEditNews( $id ){
        $categories = Category::find([1,2,3,4]);
        $types = NewsType::find([2,3]);
        $news = News::whereId( $id )->with('category','type')->first();
        return View( 'edit_news',compact('news','types','categories') );
    }

    public function PostEditNews( $id ){
        $news = News::whereId( $id )->with('category','type')->first();
        return response()->json(compact('news'));
    }

    public function UpdateNews( StoreNewsPost $request, $id ){
        $news = NewsCreator::CreateUpdate($request->all(),$id);
        return response()->json(compact('news'));
    }
}