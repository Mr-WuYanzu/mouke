@extends('layouts.layouts')

@section('title','题库')

@section('content')
    <link rel="stylesheet" href="{{asset('css/article.css')}}">
    <script src="{{asset('js/mine.js')}}"></script>

    <div class="coursepic">
        <h1 align="center">科目：{{$c_name}}</h1>
        <div class="clearh"></div>
                <?php $num=1;?>
                @foreach($paperInfo as $k=>$v)
                        <h3 align="center"><input type="checkbox">第{{$num}}题&nbsp;&nbsp;&nbsp;{{$v['t_title']}}</h3>
                        <h4 align="center">A:{{$v['a']}}</h4>
                        <h4 align="center">B:{{$v['b']}}</h4>
                        <h4 align="center">C:{{$v['c']}}</h4>
                        <h4 align="center">D:{{$v['d']}}</h4>
                <?php $num++;?>
                @endforeach
    </div>
@endsection