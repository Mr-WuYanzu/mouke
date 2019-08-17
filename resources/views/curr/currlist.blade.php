@extends('layouts.layouts')

@section('title','课程列表')

@section('content')

<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<link rel="stylesheet" href="/css/page.css">
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>
<style>
    .cat{
        color: red;
    }
</style>
<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont">
    <div class="courseleft">
	<span class="select">
        <input type="hidden" id="sear">
      <input type="text" value="" placeholder="请输入关键字" class="pingjia_con" id="search"/>
      <a href="#" class="sellink"></a>
    </span>
    <ul class="courseul">
    <li class="curr" style="border-radius:3px 3px 0 0;background:#fb5e55;"><h3 style="color:#fff;"><a href="#" class="whitea" onclick="history.go(0)">全部课程</a></h3>
        @foreach($curr_cate_info as $k=>$v)
            <li>
                <h4><span style="cursor: pointer" class="cate" cate_id="{{$v['curr_cate_id']}}">{{$v['cate_name']}}</span></h4>
                @foreach($v['son'] as $key=>$val)
                    <h6><span style="cursor: pointer" class="cate" cate_id="{{$val['curr_cate_id']}}">{{$val['cate_name']}}</span></h6>
                        <ul class="sortul">
                            @foreach($val['son'] as $kk=>$vv)
                                <li class="course_curr" ><span style="cursor: pointer" class="cate" cate_id="{{$vv['curr_cate_id']}}">{{$vv['cate_name']}}</span></li>
                            @endforeach
                        </ul>
                        <div class="clearh"></div>

                @endforeach
            </li>

        @endforeach
    </ul>
    <div style="height:20px;border-radius:0 0 5px 5px; background:#fff;box-shadow:0 2px 4px rgba(0, 0, 0, 0.1)"></div>
    </div>
    <div class="courseright">
        <div class="clearh"></div>
      <ul class="courseulr" id="cxk">
          @foreach($currInfo as $k=>$v)
                <li>
                    <div class="courselist">
                    <a href="/curr/currcont/{{$v['curr_id']}}" target="_blank"><img style="border-radius:3px 3px 0 0;" width="240" src="http://curr.img.com/{{$v['curr_img']}}" title="会计基础"></a>
                    <p class="courTit"><a href="coursecont.html" target="_blank">{{$v['curr_name']}}</a></p>
                    <div class="gray">
                    <span>{{$v['classNum']}}课时</span>
                    <span class="sp1">1255555人学习</span>
                    <div style="clear:both"></div>
                    </div>
                    </div>
               </li>
          @endforeach
    </ul>
        </div>
    <div class="pagination" style="margin: 0 auto;">
        <span class="page" title="首页" page="1">首页</span>
        {{--@if($currentPage-1<=0)--}}
        {{--<span class="page disabled" title="上一页" page="1" click_type="up">上一页</span>--}}
        {{--@else--}}
        {{--<span class="page" title="上一页" page="{{$currentPage-1}}" click_type="up">上一页</span>--}}
        {{--@endif--}}

        @for($i=1;$i<=$lastPage;$i++)
            @if($i==$currentPage)
                <span class="page current" page="{{$i}}">{{$i}}</span>
            @else
                <span class="page" page="{{$i}}">{{$i}}</span>
            @endif
        @endfor
        {{--@if($currentPage+1 > $lastPage)--}}
        {{--<span class="page disabled" page="{{$lastPage}}">下一页</span>--}}
        {{--@else--}}
        {{--<span class="page" page="{{$currentPage+1}}">下一页</span>--}}
        {{--@endif--}}
        <span class="page" page="{{$lastPage}}">尾页</span>
    </div>
    <div class="clearh"></div>
</div>
</div>
<!-- InstanceEndEditable -->

<div class="clearh"></div>

<script>
    $(document).on('click','.cate',function () {
        $('.cate').removeClass('cat');
        $(this).addClass('cat');
        var cate_id = $(this).attr('cate_id');
        var search = $('#sear').val();
        var data='';
        var cxk = $('#cxk');
        var _page = $('.pagination');//分页展示
        var pageData = '<span class="page" title="首页" page="1">首页</span>';//页码数据
        $.ajax({
            url:'/cateSearch',
            type:'post',
            data:{cate_id:cate_id,search:search},
            dataType:'json',
            success:function (res) {
                for (let index in res.currInfo.data){
                    data+='<li>' +
                        '<div class="courselist">' +
                        '<a href="/curr/currcont/'+res.currInfo.data[index].curr_id+'" target="_blank">' +
                        '<img style="border-radius:3px 3px 0 0;" width="240" src="http://curr.img.com/'+res.currInfo.data[index].curr_img+'" title="会计基础">' +
                        '</a>' +
                        '<p class="courTit"><a href="coursecont.html" target="_blank">'+res.currInfo.data[index].curr_name+'</a></p><div class="gray">'+
                        '<span>'+res.currInfo.data[index].classNum+'课时</span>'+
                        '<span class="sp1">1255555人学习</span><div style="clear:both"></div></div></div></li>';
                }
                _page.empty();
                if(res.lastPage > 1){
                    for (i=1;i<=res.lastPage;i++){
                        if(i==res.currentPage){
                            pageData+='<span class="page current" page="'+i+'">'+i+'</span>';
                        }else{
                            pageData+='<span class="page" page="'+i+'">'+i+'</span>';
                        }
                    }
                    pageData+='<span class="page" page="'+res.lastPage+'">尾页</span>';
                    _page.append(pageData);
                }

                cxk.empty();
                cxk.append(data);
            }
        })
    })
    $(document).on('click','.sellink',function () {
        var search = $('#search').val();
        $('#sear').val(search);
        var cate = $('.cate');
        var cate_id = null;
        cate.each(function (index) {
            if($(this).prop('class')=='cate cat'){
                cate_id=$(this).attr('cate_id');
            }
        })
        var data='';
        var cxk = $('#cxk');
        var _page = $('.pagination');
        $.ajax({
            url:'/cateSearch',
            type:'post',
            data:{cate_id:cate_id,search:search,page:1},
            dataType:'json',
            success:function (res) {
                for (let index in res.currInfo.data){
                    data+='<li>' +
                        '<div class="courselist">' +
                        '<a href="/curr/currcont/'+res.currInfo.data[index].curr_id+'" target="_blank">' +
                        '<img style="border-radius:3px 3px 0 0;" width="240" src="http://curr.img.com/'+res.currInfo.data[index].curr_img+'" title="会计基础">' +
                        '</a>' +
                        '<p class="courTit"><a href="coursecont.html" target="_blank">'+res.currInfo.data[index].curr_name+'</a></p><div class="gray">'+
                        '<span>'+res.currInfo.data[index].classNum+'课时</span>'+
                        '<span class="sp1">1255555人学习</span><div style="clear:both"></div></div></div></li>';
                }
                _page.empty();
                cxk.empty();
                cxk.append(data);
            }
        })
    })
    $(document).on('click','.page',function () {
        var _this = $(this);
        //页面点击
        var click_span = _this.siblings('span[class="page current"]');
        //上一页
        var up_page = _this.siblings('span[click_type=up]');
        var click_status = $(this).prop('class');
        if(click_status=='page disabled' || click_status=='page current'){
            return false;
        }
        //获取分类id当前选择的分类id
        var cate = $('.cate');
        var cate_id = null;
        cate.each(function (index) {
            if($(this).prop('class')=='cate cat'){
                cate_id=$(this).attr('cate_id');
            }
        })
        //获取搜索的关键字
        var search = $('#sear').val();
        //获取点击的页码
        var page_num = $(this).attr('page');
        var data='';
        var cxk = $('#cxk');//课程展示块
        //请求分页页面
        $.ajax({
            url:'/getPageData',
            type:'post',
            data:{cate_id:cate_id,search:search,page:page_num},
            dataType:'json',
            success:function (res) {
                //处理返回的数据
                for (let index in res.currInfo.data){
                    data+='<li>' +
                        '<div class="courselist">' +
                        '<a href="/curr/currcont/'+res.currInfo.data[index].curr_id+'" target="_blank">' +
                        '<img style="border-radius:3px 3px 0 0;" width="240" src="http://curr.img.com/'+res.currInfo.data[index].curr_img+'" title="会计基础">' +
                        '</a>' +
                        '<p class="courTit"><a href="coursecont.html" target="_blank">'+res.currInfo.data[index].curr_name+'</a></p><div class="gray">'+
                        '<span>'+res.currInfo.data[index].classNum+'课时</span>'+
                        '<span class="sp1">1255555人学习</span><div style="clear:both"></div></div></div></li>';
                }
                //后期会做上一页下一页功能
                // if(res.currentPage-1 <= 0){
                //     up_page.prop('class','page disabled');
                //     up_page.attr('page',1);
                // }else{
                //     up_page.prop('class','page');
                //     up_page.attr('page',res.currentPage-1);
                // }
                click_span.prop('class','page');
                _this.prop('class','page current');
                cxk.empty();
                cxk.append(data);
            }
        })

    })
</script>
@endsection