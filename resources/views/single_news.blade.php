@extends('layouts.app')

@section('content')
    <div class="col-12">
        <h1 class="display-4">{{$news->title}}</h1>
        <h4 class="text-info">{{$news->category->name}} ({{$news->type->name}})</h4>
    </div>
    <div class="col-12 mt-4">
        <p>{{$news->content}}</p>
        @if($news->type_id === 4)
            <div>
                <p class="">Всего новостей: {{$news->extend['count']}}</p>
                <ul>
                    @foreach($news->extend['link'] as $link)
                        <li>
                            <a href="{{route('single_news', [$link['id']])}}">{{$link['title']}}</a>
                        </li>
                    @endforeach

                </ul>
            </div>
        @endif
        @if($news->type_id === 1)
                <p class="">
                    Температура: <b>{{$news->extend['temperature']}}</b>.
                    Давление: <b>{{$news->extend['pressure']}}</b>.
                    Состояние: <b>{{$news->extend['sost']}}</b>.
                </p>
        @endif

        <p class="">
            <small>{{$news->created_at}}</small>
        </p>
        <a class="btn btn-outline-success" href="{{route('edit_news', [$news->id])}}">Редактировать</a>
    </div>
@endsection