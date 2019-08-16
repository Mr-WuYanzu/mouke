@extends('layouts.layouts')

@section('title','课程列表')

@section('content')

<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
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
      <input type="text" value="" placeholder="请输入关键字" class="pingjia_con" id="search"/>
      <a href="#" class="sellink"></a>
    </span>
    <ul class="courseul">
    <li class="curr" style="border-radius:3px 3px 0 0;background:#fb5e55;"><h3 style="color:#fff;"><a href="#" class="whitea">全部课程</a></h3>
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
        var data='';
        var cxk = $('#cxk');
        $.ajax({
            url:'/cateSearch',
            type:'post',
            data:{cate_id:cate_id},
            dataType:'json',
            success:function (res) {
                for (let index in res){
                    data+='<li>' +
                        '<div class="courselist">' +
                        '<a href="/curr/currcont/'+res[index].curr_id+'" target="_blank">' +
                        '<img style="border-radius:3px 3px 0 0;" width="240" src="/images/c1.jpg" title="会计基础">' +
                        '</a>' +
                        '<p class="courTit"><a href="coursecont.html" target="_blank">'+res[index].curr_name+'</a></p><div class="gray">'+
                        '<span>'+res[index].classNum+'课时</span>'+
                        '<span class="sp1">1255555人学习</span><div style="clear:both"></div></div></div></li>';
                }
                cxk.empty();
                cxk.append(data);
            }
        })
    })
    $(document).on('click','.sellink',function () {
        var search = $('#search').val();
        var cate = $('.cate');
        var cate_id = null;
        cate.each(function (index) {
            if($(this).prop('class')=='cate cat'){
                cate_id=$(this).attr('cate_id');
            }
        })
        var data='';
        var cxk = $('#cxk');
        $.ajax({
            url:'/cateSearch',
            type:'post',
            data:{cate_id:cate_id,search:search},
            dataType:'json',
            success:function (res) {
                for (let index in res){
                    data+='<li>' +
                        '<div class="courselist">' +
                        '<a href="/curr/currcont/'+res[index].curr_id+'" target="_blank">' +
                        '<img style="border-radius:3px 3px 0 0;" width="240" src="/images/c1.jpg" title="会计基础">' +
                        '</a>' +
                        '<p class="courTit"><a href="coursecont.html" target="_blank">'+res[index].curr_name+'</a></p><div class="gray">'+
                        '<span>'+res[index].classNum+'课时</span>'+
                        '<span class="sp1">1255555人学习</span><div style="clear:both"></div></div></div></li>';
                }
                cxk.empty();
                cxk.append(data);
            }
        })
    })
</script>
@endsection