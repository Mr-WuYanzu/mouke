   <ul class="courseul" id="myTab3_Content{{$data['re_num']}}" style="display: block;">
   	@foreach($currInfo as $v)
    <li curr_id='{{$v['curr_id']}}'>
    	<div class="courselist">
        <img width="263" class="curr_img" style="border-radius:3px 3px 0 0;" src="{{$v['curr_img']}}" >
        <p class="courTit"><a style="text-decoration:none;color:gray;" href="/curr/currcont/{{$v['curr_id']}}">{{$v['curr_name']}}</a></p>
        <div class="gray">
        <span>1小时前更新</span>
        <span class="sp1">1255555人学习</span>
        <div style="clear:both"></div>
        </div>
        </div>
   </li>
   @endforeach
   <div class="clearh"></div>
  </ul>               

<script type="text/javascript">
  $(function(){
    layui.use(['layer'],function(){
      $('.curr_img').click(function(){
        var curr_id=$(this).parents('li').attr('curr_id');
        location.href='/curr/currcont/'+curr_id;
      });
    });
  });
</script>