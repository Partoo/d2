<?php
/**
*Send mobile sms
*return status-code
* $type is msg type
* 0:authenicate code;
* 1:document status;
* 2:other msg;
* 3:safety warning;
*/
namespace App\Libs;
class Sms
{
//Generate random 4bits number
  static function getCode()
  {
   $chars = array(
     "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"
     );
   $charsLen = count($chars) - 1;
   shuffle($chars);
   $output = "";
   for ($i=0; $i<4; $i++)
   {
    $output .= $chars[mt_rand(0, $charsLen)];
  }
  return $output;
}

// 生成并发送短信，注意，验证码从session中获取
// session的值在 Authcontroller@sendSms Action生成
// 用于防止直接通过route('sendSms')发送短信
public function Sendsms($mobile,$type='0')
{
 $curl = new \Curl();
 $accesskey = '859';
 $secretkey = 'ff82b7e314b53e7857e0b80ee3ff174e75e71814';
 $postUrl = 'http://sms.bechtech.cn/Api/send/data/json?';
 $authCode = \Session::get('mcode');
 switch ($type) {
  case '0':
  $content='您的办公系统验证码为:'.$authCode.',请即刻输入验证【iStar】';
  break;
  case '1':
  $content='您的办公系统收到了新的公文审批请示，请登录系统查看【iStar】';
  break;
  case '2':
  $content='您的办公系统有了新的公文动态，请登录系统查看【iStar】';
  break;
  case '3':
  $content='您的办公系统用户信息有变化，请留意【iStar】';
  break;
}
$curlPost = 'accesskey='.$accesskey.'&secretkey='.$secretkey.'&mobile='.$mobile.'&content='.$content;

$curl->simple_get($postUrl.$curlPost);

return $curl->last_response;
}

}

