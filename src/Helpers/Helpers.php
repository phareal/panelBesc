<?php
namespace App\Helpers;

class Helpers{

    public static function generateIdentificationNumber(){
        $prefixe="VGM-";
        $alphabet="QWERTYUIOPASDFGHJKLZXCVBNM";
        $number="1234567890";

        $_first=self::_shuffle(3,$alphabet);
        $_second=self::_shuffle(4,$number);
        $_third=self::_shuffle(3,$number);
        return $prefixe.$_first.$_second.'-'.$_third;

    }

    public static function _shuffle($length,$string){
        return substr(str_shuffle(str_repeat($string,$length)),0,$length);
    }


    static function generateContainerIdentificationNumber($rav,$group,$serieNumberm,$verificationCode){
        return $rav.'-'.$group.'-'.$serieNumberm.'-'.$verificationCode;
    }
}
