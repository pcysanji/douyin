header('Content-type: application/json');
$_u = $_GET['_u'];
function _g($_u,$_n=0) {
  $_h = curl_init();
  curl_setopt($_h, CURLOPT_URL, $_u);
  curl_setopt($_h, CURLOPT_RETURNTRANSFER, 1); 
  curl_setopt($_h, CURLOPT_HEADER, false);
  curl_setopt($_h, CURLOPT_HTTPHEADER, array(
          'user-agent:Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/72.0.3626.121 Mobile Safari/537.36'
  ));
  if($_n==1){
    curl_setopt($_h, CURLOPT_NOBODY, 1);
          curl_setopt($_h, CURLOPT_FOLLOWLOCATION, 1);
    curl_exec($_h);
          $_r = curl_getinfo($_h, CURLINFO_EFFECTIVE_URL);
  }else{
    $_r = curl_exec($_h);
  }
  curl_close($_h);
  return $_r;
}
if(strpos($_u,'com') !== false){
          $_u = _g(_g($_u,1));
    preg_match('/class=\"video-player\" src=\"(.*?)\" preload/is', $_u, $_m);
          $_m = str_replace("line=0","line=1",str_replace("playwm","play",$_m[1]));
          $_v = _g($_m,1);
          if($_v==''){
            $_c = 0701.1;
              $_s = 'error';
    }else{
              $_c = 0;
            $_s = 'success';
    }
}else{
        $_c = 0701.2;
          $_s = 'url does not match';
}
echo json_encode(array("code" => $_c, "errMsg" => $_s,"videoUrl" => $_v,"tmp" => time()), JSON_UNESCAPED_SLASHES);