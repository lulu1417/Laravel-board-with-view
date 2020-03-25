<?php


namespace App;


class CalculateTime
{
    static function transfer($time)
    {
        if(strpos($time, date("Y-m-d")) == 0){
            $now = date("Y-m-d H:i:s");

            $result['hour'] = floor((strtotime($now) - strtotime($time)) / 3600);
            $result['min'] = floor(  (strtotime($now)- ($result['hour']*3600) - strtotime($time))/ 60);
            $result['second'] = floor(  (strtotime($now)- ($result['hour']*3600) - ($result['min']*60) - strtotime($time))% 60);

            return $result;

        }else{
            return 'more than 24';
        }

    }
}
