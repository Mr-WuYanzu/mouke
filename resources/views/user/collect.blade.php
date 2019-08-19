<div class="membcont">
        <h3 class="mem-h3">我的收藏</h3>
        <div class="box demo2" style="width:820px;">
            <ul class="tab_menu" style="margin-left:30px;">
                <li class="current">收藏</li>
            </ul>
            <div class="tab_box">
                <div>
                    {{--收藏课程--}}
                    <ul class="memb_course">
                        @foreach($collectInfo as $k=>$v)
                        <li curr_id="{{$v['curr_id']}}">
                            <div class="courseli">
                                <a href="/curr/currcont/{{$v['curr_id']}}" target="_blank"><img width="230" src="{{$v['curr_img']}}"></a>
                                <p class="memb_courname"><a href="/curr/currcont/{{$v['curr_id']}}" class="blacklink">{{$v['curr_name']}}</a></p>
                                <div class="mpp">
                                    <div class="lv" style="width:20%;"></div>
                                </div>
                                <p class="goon">
                                    <a href="/curr/currcont/{{$v['curr_id']}}"><span>继续学习</span></a>
                                    <a style="cursor: pointer;" class="cancel"><span>取消收藏</span></a>
                                </p>
                            </div>
                        </li>
                        @endforeach
                        <div style="height:10px;" class="clearfix"></div>
                    </ul>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function(){
            layui.use(['layer'],function(){
                var layer=layui.layer;

                $('.cancel').click(function(){
                    var _this=$(this);
                    var curr_id=_this.parents('li').attr('curr_id');

                    $.post(
                        '/user/cancelCollect',
                        {curr_id:curr_id},
                        function(res){
                            layer.msg(res.font,{icon:res.skin,time:1000},function(){
                                if(res.code==1){
                                    history.go(0);
                                }
                            });
                        },
                        'json'
                    )
                });

                $('.demo2').Tabs({
                    event:'click'
                });

            });
        });
    </script>