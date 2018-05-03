<?php
header("Content-type: text/html; charset=utf-8");
http_response_code(500);
if(\think\facade\App::isDebug()){
    die(json_encode(['msg'=>$message]));
}
die(json_encode(['msg'=>lang('ERROR_500')]));
?>
