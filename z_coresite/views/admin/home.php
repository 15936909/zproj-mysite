<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>后台管理</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="stylesheet" href="<?php echo zStaticUrl('css/bs/css/bootstrap.css'); ?>" />
<link rel="stylesheet" href="<?php echo zStaticUrl('css/bs/css/bootstrap-responsive.css'); ?>" />
<link rel="stylesheet" href="<?php echo zStaticUrl('css/admin.css'); ?>" />
<script type="text/javascript" src="<?php echo zStaticUrl('js/lib/jquery.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo zStaticUrl('js/lib/bootstrap.min.js'); ?>"></script>
<script type="text/javascript">
$(function(){

    // 渲染侧边栏开关
    $('.toggle-sidebar').click(function(e){
        e.preventDefault();
        hideSidebar();
    });

    // 渲染布局
    renderLayout();

    // 绑定窗口改变大小事件处理，重新渲染布局
    $(window).on("resize", function(){
        renderLayout();
    });
});

/**
 * 获取侧边栏总高度
 */
function getSidebarScrollHeight(){

    var $left = $("#left"),
        $win = $(window),
        $nav = $("#navigation");

    var winHeight = $win.height(),
        winScrollTop = $win.scrollTop();

    if(winScrollTop == 0 || ($nav.hasClass("navbar-fixed-top") && winScrollTop == 0)) {
        winHeight -= $nav.outerHeight(true);
    }

    if($left.hasClass("sidebar-fixed") || $left.hasClass("mobile-show")){
        $left.height(winHeight);
    }
}

/**
 * 隐藏侧边栏
 */
function hideSidebar(){

    var $left = $("#left"),
        $main = $("#main");

    $left.toggle();

    if($left.is(":visible")) {
        $main.css("margin-left", $left.width());
    } else {
        $main.css("margin-left", 0);
    }
}

/**
 * 渲染布局
 */
function renderLayout(){

    var $win = $(window),
        $nav = $("#navigation"),
        $rightMain = $("#rightMain");

    $rightMain.height($win.height() - $nav.outerHeight(true));
}

/**
 * 退出登录
 */
function logout(){
    if (confirm("确定要退出登录？")) {
        top.location = '<?php echo zUrl('admin/login/logout'); ?>';
    }
    return false;
}

/**
 * 打开主导航菜单项
 */
function _M(mid, sid, url, name) {
	$('.main-nav > li, .dropdown-menu > li').removeClass("active");
	$('#_M_'+mid).addClass("active");
	$(".d_menu").hide();
	$("#D_M_"+mid).show();
	_MP(sid, url);
}

/**
 * 打开子导航菜单项页面
 */
function _MP(id, url) {
	$("#rightMain").attr('src', url);
	$(".subnav-menu > li").removeClass("dropdown");
	$("#_MP_"+id).addClass("dropdown");
    $("#_MP_"+id).parent().show();
    $("#_MP_"+id).parent().parent().attr('class', 'subnav');
    if (url.indexOf('http') == -1) {
        dr_loading();
    }
}

</script>
</head>
<body style="overflow: hidden;">


<!-- 导航 -->
<div class="container-fluid" id="navigation">

    <a class="logo" href="<?php echo zUrl('coupon/exchange'); ?>" target="_blank">ADMIN</a>

    <a class="toggle-nav" href="javascript:;">
    	<i class="icon-align-justify"></i>
    </a>

    <div class="user">
        <div class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:;"><?php echo $adminuser['realname']; ?></a>
            <ul class="dropdown-menu pull-right">
                <li><a href="javascript:;" onClick="logout();"><i class="icon-signout"></i>退出登录</a></li>
            </ul>
        </div>
    </div>

</div>


<!-- 内容 -->
<div id="content">

    <!-- 侧边栏 -->
    <div id="left">
    	
    	<div id="D_M_0">
    		<div class="subnav subnav-hidden">
    			<div class="subnav-title">
	    			<a href="#" class="toggle-subnav">
	    				<i class="icon-angle-down"></i><span>当前菜单</span>
	    			</a>
    			</div>
    			<ul class="subnav-menu" style="">
    				<li id="_MP_1"><a href="javascript:_MP('1', 'admin.php?c=adminuser&m=index');">管理员列表</a></li>
    				<li id="_MP_2"><a href="javascript:_MP('2', 'admin.php?c=coupon&m=index');">优惠券列表</a></li>
    				<li id="_MP_3"><a href="javascript:_MP('3', 'admin.php?c=couponexchangelog&m=index');">优惠券兑换列表</a></li>
    			</ul>
    		</div>
    	</div>
				
    </div>

    <!-- 主要栏 -->
    <div id="main">
        <iframe id="rightMain" name="right" src="<?php echo zUrl('admin/coupon/index'); ?>" style="width: 100%; height: 100%; border: none; vertical-align: middle;" ></iframe>
    </div>

</div>


</body>
</html>
