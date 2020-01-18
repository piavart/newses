@extends('layouts.app')

@section('content')
    <div class="col-12 text-center">
        <h1 class="display-4">Новая запись</h1>

    </div>
    <div class="col-12">
        <news-create-form
                :categories="{{json_encode($categories)}}"
                :types="{{json_encode($types)}}"
        >
            </news-create-form:>
    </div>
@endsection