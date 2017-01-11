<?php
$site_url = 'http://' . $_SERVER['HTTP_HOST'] . "/";
$act = $_GET['act'];
if ($act != '') {
    if ($act == 'jsCompress') {
       echo  getCurl($site_url);
//        file_get_contents($site_url . "Public/js/common.js");
    }
    exit;
}

function getCurl($site_url) {
    $url = "http://tool.oschina.net/action/jscompress/js_compress?munge=0&linebreakpos=5000";
    $content = file_get_contents($site_url . "Public/js/common.js");
    $post_data = array(
        "linebreak"=>5000,
      "file"=>  122,
        "munge"=>0
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}

function get_extension($file) {
    return strtolower(substr(strrchr($file, '.'), 1));
}

$scandirJs = scandir("js");
foreach ($scandirJs as $v) {
    if (get_extension($v) == 'js') {
        if (!strstr($v, 'all')) {
            $filesJs[] = $v;
        }
    }
}
//print_r($filesJs);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
        <title>压缩</title>
        <script src="js/jquery.js" type="text/javascript"></script>
    </head>
    <body>
        <script>
            function jsCompress() {//http://tool.oschina.net/action/jscompress/multi_js_compress
                $.get("compress.php?act=jsCompress", {
                }, function(data) {

                })
            }

        </script>
        <?php
        foreach ($filesJs as $v) {
            ?>
            <p><input name="js" type="checkbox" value="<?php echo $site_url . "Public/js/" . $v; ?>" autocomplete="off"/><?php echo $v; ?></p>
        <?php } ?>
        <input type="button" onclick="jsCompress()" value="js压缩"/>


