<?php
class Service {

    public $service_id;
    public $owner_uid;
    public $name;
    public $logo_path;
    public $picture_path;
    public $facebook_url;
    public $open_days;
    public $open_time;
    public $close_time;
    public $tel;
    public $address;
    public $latitude;
    public $longitude;
    public $description;

    public function __construct(){
    }

    public function getDaysOpen(){
        $everyday = 'ทุกวัน';
        $isEveryday = true;
        for($i=0; $i<strlen($this->open_days);++$i){
            if($this->open_days[$i] == 0){
                $isEveryday = false;
                break;
            }
        }
        if($isEveryday) return $everyday;
        $out = '';
        if($this->open_days[0] == 1) $out .= 'อา ';
        if($this->open_days[1] == 1) $out .= 'จ ';
        if($this->open_days[2] == 1) $out .= 'อ ';
        if($this->open_days[3] == 1) $out .= 'พ ';
        if($this->open_days[4] == 1) $out .= 'พฤ ';
        if($this->open_days[5] == 1) $out .= 'ศ ';
        if($this->open_days[6] == 1) $out .= 'ส ';
        return $out;
    }

    public function getOpenTime(){
        return substr($this->open_time, 0, 5);
    }

    public function getCloseTime(){
        return substr($this->close_time, 0, 5);
    }

}