@extends('layouts.app')

@section('content')
   <div class="col-12 text-center">
       <h1 class="display-4">Новостной блог</h1>
   </div>
    <div class="col-12">
        <news :categories="{{json_encode($categories)}}"></news>

    </div>
@endsection