@extends('layouts.layouts')

@section('title','题库')

@section('content')
    <link rel="stylesheet" href="{{asset('css/article.css')}}">
    <script src="{{asset('js/mine.js')}}"></script>

    <div class="coursepic">
        <h3 class="righttit" align="center">科目：</h3>
        <div class="clearh"></div>
        <span class="bread nob" align="center">
        @foreach($cate_name as $k=>$v)
                <a class="fombtn cur" href="/item_bank?c_id={{$v->c_id}}">{{$v->c_name}}</a>
        @endforeach
        </span>
    </div>







@endsection