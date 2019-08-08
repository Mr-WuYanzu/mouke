
<div class="foot">
<div class="fcontainer">
      <div class="fwxwb"> 
	       <div class="fwxwb_1">
		       <span>关注微信</span><img width="95" alt="" src="{{asset('images/num.png')}}">
		   </div>
           <div>
               <span>关注微博</span><img width="95" alt="" src="{{asset('images/wb.png')}}">
		   </div>	              
      </div>
      <div class="fmenu">
	     <p><a href="#">关于我们</a> | <a href="#">联系我们</a> | <a href="#">优秀讲师</a> | <a href="#">帮助中心</a> | <a href="#">意见反馈</a> | <a href="#">加入我们</a></p>
      </div>
      <div class="copyright">      
        <div><a href="/">谋刻网</a>所有&nbsp;晋ICP备12006957号-9</div>
      </div>
    </div>
</div>


<!--右侧浮动-->
<div class="rmbar">
	<span class="barico qq" style="position:relative">
	<div  class="showqq">
	   <p>官方客服QQ:<br>335049335</p>
	</div>
	</span>
	<span class="barico em" style="position:relative">
	  <img src="{{asset('images/num.png')}}" width="75" class="showem">
	</span>
	<span class="barico wb" style="position:relative">
	  <img src="{{asset('images/wb.png')}}" width="75" class="showwb">
	</span>	
	<span class="barico top" id="top">置顶</span>	
</div>

<script>
function logmine(){
	document.getElementById("lne").style.display="block";
}
function logclose(){
	document.getElementById("lne").style.display="none";	
}

 /*右侧客服飘窗*/
	$(".label_pa li").click(function() {
		$(this).siblings("li").find("span").css("background-color", "#fff").css("color", "#666");
		$(this).find("span").css("background", "#fb5e55").css("color", "#fff");
	});
	$(".em").hover(function() {
		$(".showem").toggle();
	});
	$(".qq").hover(function() {
		$(".showqq").toggle();
	});
	$(".wb").hover(function() {
		$(".showwb").toggle();
	});
	$("#top").click(function() {
		if (scroll == "off") return;
		$("html,body").animate({
			scrollTop: 0
		},
		600);
	});
</script>

</body>
</html>