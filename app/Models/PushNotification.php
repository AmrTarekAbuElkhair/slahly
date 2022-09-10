<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PushNotification extends Model
{
    public static function send($tokens, $msg , $type)
    {
        $fields = array
        (
            "registration_ids" => $tokens,
            "priority" => 10,
            'data' => [
                'title' => "",
                'sound' => 'default',
                'message' => $msg,
                'type' => $type
            ],
            'notification' => [
                'type'    => $type,
                'text' => $msg,
                'title' => "",
                'sound' => 'default'
            ],
            'vibrate' => 1,
            'sound' => 1
        );
        $headers = array
        (
            'accept: application/json',
            'Content-Type: application/json',
            'Authorization: key=' .
            'AAAAzqKPRo8:APA91bF3MlTMn8v8ypTBByxCJwJzwmbnEI_G16sXSDQIjhM3B-SEwUNxR45a8Yb4XZacga0NjAKahqwNQPJkN8RO-HkvnnzisWKid9MSSkvdj_jfUwx5KPYeGJKfk18axdMx7cvRcM6T'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        //  var_dump($result);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }


    public static function send_details($tokens,$title,$order_number,$message,$details ,$type='')
    {

        $fields = array
        (
            "registration_ids" => $tokens,
            "priority" => 10,
            'data' => [
                'status' => $title,
                'order_number'=>$order_number,
                'message' => $message,
                'order_id'=>$details,
                'type' => $type
            ],
            'notification' => [
                'status' => $title,
                'order_number'=>$order_number,
                'message' => $message,
                'order_id'=>$details,
                'type'    => $type,
            ],
            'vibrate' => 1,
        );
        //dd( $fields);
        $headers = array
        (
            'accept: application/json',
            'Content-Type: application/json',
             'Authorization: key=' .
            'AAAAzqKPRo8:APA91bF3MlTMn8v8ypTBByxCJwJzwmbnEI_G16sXSDQIjhM3B-SEwUNxR45a8Yb4XZacga0NjAKahqwNQPJkN8RO-HkvnnzisWKid9MSSkvdj_jfUwx5KPYeGJKfk18axdMx7cvRcM6T'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        //  var_dump($result);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
    public static function send_details_driver($tokens,$title,$message, $details , $q=null,$type='')
    {

        $fields = array
        (
            "registration_ids" => $tokens,
            "priority" => 10,
            'data' => [
                // 'title' => $msg,
//                  'title' => $title,
                'message' => $message,
                'details' => $details,
                'type' => $type,
                'title' => ""
            ],
            'notification' => [
//                    'title' => $title,
                'message' => $message,
                'body' => $message,
                'details' => $details,
                'type' => $type,
                'title' => ""
            ],
            'vibrate' => 1,
            'sound' => 1
        );
        $headers = array
        (
            'accept: application/json',
            'Content-Type: application/json',
            'Authorization: key=' .
            'AAAAzqKPRo8:APA91bF3MlTMn8v8ypTBByxCJwJzwmbnEI_G16sXSDQIjhM3B-SEwUNxR45a8Yb4XZacga0NjAKahqwNQPJkN8RO-HkvnnzisWKid9MSSkvdj_jfUwx5KPYeGJKfk18axdMx7cvRcM6T'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        //  var_dump($result);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        curl_close($ch);
        return $result;
    }
}
