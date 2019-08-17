 <div class="membcont">
        <h3 class="mem-h3">我的课程</h3>
        <div class="box demo2" style="width:820px;">
            <ul class="tab_menu" style="margin-left:30px;">
                <li class="current">学习中</li>
                <li>已学完</li>
            </ul>
            <div class="tab_box">
                <div>
                    {{--学习中课程--}}
                    <ul class="memb_course">
                        @foreach($currInfo as $k => $v)
                        <li>
                            <div class="courseli">
                                <a href="/curr/currcont/{{$v['curr_id']}}" target="_blank"><img width="230" src="{{$v['curr_img']}}"></a>
                                <p class="memb_courname"><a href="/curr/currcont/{{$v['curr_id']}}" class="blacklink">{{$v['curr_name']}}</a></p>
                                <div class="mpp">
                                    <div class="lv" style="width:20%;"></div>
                                </div>
                                <p class="goon"><a href="/curr/currcont/{{$v['curr_id']}}"><span>继续学习</span></a></p>
                            </div>
                        </li>
                        @endforeach
                        <div style="height:10px;" class="clearfix"></div>
                    </ul>
                </div>

                <div class="hide">
                    <div>
                        {{--已学完课程--}}
                        <ul class="memb_course">
                            <li>
                                <div class="courseli">
                                    <a href="video.html" target="_blank"><img width="230" src="images/c8.jpg"></a>
                                    <p class="memb_courname"><a href="coursecont.html" class="blacklink">会计基础</a></p>
                                    <div class="mpp">
                                        <div class="lv" style="width:100%;"></div>
                                    </div>
                                    <p class="goon"><a href="coursecont.html"><span>查看课程</span></a></p>
                                </div>
                            </li>
                            <li>
                                <div class="courseli">
                                    <a href="video.html" target="_blank"><img width="230" src="images/c8.jpg"></a>
                                    <p class="memb_courname"><a href="coursecont.html" class="blacklink">会计基础</a></p>
                                    <div class="mpp">
                                        <div class="lv" style="width:100%;"></div>
                                    </div>
                                    <p class="goon"><a href="coursecont.html"><span>查看课程</span></a></p>
                                </div>
                            </li>
                            <div class="clearfix" style="height:10px;"></div>
                        </ul>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function(){
            layui.use(['layer'],function(){

                $('.demo2').Tabs({
                    event:'click'
                });

            });
        });
    </script>