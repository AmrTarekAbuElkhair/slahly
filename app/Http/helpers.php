<?php
use Illuminate\Support\Facades\Config;

function success()
{
    return 'success';
}

function error()
{
    return 'error';
}
function expired()
{
    return 'expired';
}


function failed()
{
    return 'failed';
}
function res($lang,$status,$code,$key,$data=null)
{
    $response['code'] = $code;
    $response['status']=$status;
    $response['msg'] = Config::get('response.'.$key.'.'.$lang);
    if ($data!=null){
        $response['data'] = $data;
    }else{
        $response['data'] = [];
    }
    return $response;
}

function res_msg($lang,$status,$code,$key)
{
    $response['code'] = $code;
    $response['status']=$status;
    $response['msg'] = Config::get('response.'.$key.'.'.$lang);
    return $response;
}


function _fireSMS($phone, $code)
{
	$username='fyw5g5dr';
	$password='H45q7qNw9i';
    $code = urlencode($code);
    $url = "https://smsmisr.com/api/vSMS/?Username=$username&password=$password&Msignature=6241952179&Token=41ea1135-25c1-4488-9c75-678335313410&Mobile=$phone&Code=$code";
    $ch = curl_init();
    $headers = array(
        'Content-Type:application/json',
        'Authorization:Basic ' . base64_encode("$username:$password")
    );
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, array());
    $data = curl_exec($ch);
    curl_close($ch);
    $decodedData = json_decode($data);
    return $decodedData;
}


function pushnotification($token , $title , $body ,$order_id= null,$type= null){

        $SERVER_API_KEY = 'AAAAzqKPRo8:APA91bF3MlTMn8v8ypTBByxCJwJzwmbnEI_G16sXSDQIjhM3B-SEwUNxR45a8Yb4XZacga0NjAKahqwNQPJkN8RO-HkvnnzisWKid9MSSkvdj_jfUwx5KPYeGJKfk18axdMx7cvRcM6T';
        $token_1 = $token ;
        $data = [
            "registration_ids" => [
                $token_1
            ],

            "notification" => [
                'sound' => 'default',
                'title' => $title,
                'body' => $body,
                'message' => $body,
                'order_id' => $order_id,
                'type'=> $type,
            ],
            "data" => [
                'title' => $title,
                'body' => $body,
                'redirectID' => $order_id,
                'redirectType'=> $type,
            ],
            'vibrate'=>1,
            'sound'=>1,
        ];
          
        $dataString = json_encode($data);
        $headers = [

            'Authorization: key=' . $SERVER_API_KEY,

            'Content-Type: application/json',

        ];
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');

        curl_setopt($ch, CURLOPT_POST, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);

        $response=curl_exec($ch);
        //dd($response);
        $object=(object)$data['data'];
        return $object;
}



