<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo($nopage); ?></title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
.system-message{
    width:400px;margin:200px auto;text-align:left;border:1px solid #ccc; 
z-index:999999; background:#fff;text-align:center;
webkit-box-shadow:0 2px 5px 1px rgba(0,0,0,.1);-moz-box-shadow:0 2px 5px 1px rgba(0,0,0,.1);
-khtml-box-shadow:0 2px 5px 1px rgba(0,0,0,.1);-ms-box-shadow:0 2px 5px 1px rgba(0,0,0,.1);
box-shadow:0 2px 5px 1px rgba(0,0,0,.1);padding:15px;
}
.system-message h1{ font-size: 36px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
.system-message .jump{ padding-top: 10px;color: #ccc;}
.system-message .jump a{ color: #999;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
.system-message .success{
    color:#1b9103;
}
.system-message .error{
    color:#F57543;
}
</style>
</head>
<body>
<div class="system-message">
<present name="message">
<p class="success">:(<?php echo($message); ?></p>
<else/>
<p class="error">:)<?php echo($error); ?></p>
</present>
<p class="jump">  <?php echo($jumpWords); ?></p>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>
    