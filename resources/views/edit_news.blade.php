@extends('layouts.app')

@section('content')
    <div class="col-12">
        <h1 class="display-4">{{$news->title}}</h1>
        <h4 class="text-info">{{$news->category->name}} ({{$news->type->name}})</h4>
    </div>
    <div class="col-12 mt-4">
        @if(in_array($news->type_id,[1,4]))
            <div class="alert alert-danger">
                <p>Данная новость создана автоматически и не может быть отредактирована</p>
            </div>
        @else
            <edit
                    :categories="{{json_encode($categories)}}"
                    :types="{{json_encode($types)}}"
                    :id="{{$news->id}}"
            ></edit>
        @endif
    </div>
@endsection