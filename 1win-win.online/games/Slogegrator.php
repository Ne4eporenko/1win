<?php


class Slotegrator
{
    private $uid = null;

    CONST Merchant_ID = "0e0fe5a211cc39574de3203db4e43108";
    CONST Merchant_Key = "557b3020de36e243c80d9d2dabc1638f1475d03c";
    CONST API_URL = "https://prod.gamerouter.pw/api/index.php/v1";
//    CONST Merchant_ID = "036884e7094f1f203cec947006232587";
//    CONST Merchant_Key = "64f3031ea1f5d525bb1635c33d2632ce3ab6d3ab";
//    CONST API_URL  = "https://turnkey.casino/api/index.php/v1";

    private function getUid() {
        return $this->uid;
    }

    public function headers($headers, $post, $time, $xNonce) {
        $mergedParams = array_merge($post,$headers);
        ksort($mergedParams);
        $hashString = http_build_query($mergedParams);
        $XSign = hash_hmac('sha1', $hashString, self::Merchant_Key);
        $headers = array(
            'X-Merchant-Id:'. self::Merchant_ID,
            'X-Timestamp:'.$time,
            'X-Nonce:'. $xNonce,
            'X-Sign:'. $XSign
        );
        return $headers;
    }
    public function gameInit($game_uid, $is_demo, $lang) {
        if (!$lang) {
            $lang = 'en';
        }

        $time = time();
        $xNonce = md5(uniqid(mt_rand(), true));

        $post = array (
            'game_uuid' => $game_uid,
            'return_url' => 'https://1win-1win.online/',
            'language' => $lang
        );
        $url= self::API_URL. '/games/init-demo';


        $headers = [
            'X-Merchant-Id' => self::Merchant_ID,
            'X-Timestamp' => $time,
            'X-Nonce' => $xNonce
        ];
        $headers = $this->headers($headers, $post, $time, $xNonce);


        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $res = curl_exec($ch);
        curl_close($ch);
        if ($res) {
            return $res;
        }
    }

}

//$s = new Slotegrator();
//$s->gameInit('557c4887ea2692bf47ed2bc7e4b80e586bdaee96', true, 'ru');
