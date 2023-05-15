<?php
use Jenssegers\Date\Date;
Date::setLocale('th');

function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);

    $interval = date_diff($datetime1, $datetime2);

    return $interval->format($differenceFormat);
}



function getCountDay($begin,$end){

    
    $dArr1 = preg_split("/-/", $begin);
    list($year1, $month1, $day1) = $dArr1;
    $Day1 = mktime(0,0,0,$month1,$day1,$year1);

    $dArr2 = preg_split("/-/", $end);
    list($year2, $month2, $day2) = $dArr2;
    $Day2 = mktime(0,0,0,$month2,$day2,$year2);

    return round(abs( $Day2 - $Day1 ) / 86400 );
}

function get_dmY($date){
    $dayTH = Date::parse($date)->format('d');
    $monthTH = Date::parse($date)->format('m');
    $yearTH = Date::parse($date)->format('Y')+543;
    return "$dayTH-$monthTH-$yearTH";
}

function get_Ymd($date){
    return Date::parse($date)->format('Y-m-d');
}

function get_dateTime($date){
    $dayTH = Date::parse($date)->format('d');
    $monthTH = Date::parse($date)->format('F');
    $yearTH = Date::parse($date)->format('Y')+543;
    $timeTH = Date::parse($date)->format('H:i');
    return "$dayTH $monthTH $yearTH $timeTH";
}

function get_dateTime_dmY($date){
    $dayTH = Date::parse($date)->format('d');
    $monthTH = Date::parse($date)->format('m');
    $yearTH = Date::parse($date)->format('Y')+543;
    $timeTH = Date::parse($date)->format('H:i');
    return "$dayTH-$monthTH-$yearTH $timeTH";
}

function get_jFY($date){
    $dayTH = Date::parse($date)->format('j');
    $monthTH = Date::parse($date)->format('F');
    $yearTH = Date::parse($date)->format('Y')+543;
    return "$dayTH $monthTH $yearTH";
}

function get_FY($date){
    $yearTH = Date::parse($date)->format('Y')+543;
    $monthTH = Date::parse($date)->format('F');
    return "$monthTH $yearTH";
}

function get_diffForHumans($date){
    return Date::parse($date)->diffForHumans();
}

function get_timespan($begin,$end){

    return Date::parse($end)->timespan($begin);
}


/*
function formatDateThat($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strMonthThai=$strMonthCut[$strMonth];
    return "$strDay $strMonthThai $strYear $strHour:$strMinute";
}
*/


const BAHT_TEXT_NUMBERS = array('ศูนย์', 'หนึ่ง', 'สอง', 'สาม', 'สี่', 'ห้า', 'หก', 'เจ็ด', 'แปด', 'เก้า');
const BAHT_TEXT_UNITS = array('', 'สิบ', 'ร้อย', 'พัน', 'หมื่น', 'แสน', 'ล้าน');
const BAHT_TEXT_ONE_IN_TENTH = 'เอ็ด';
const BAHT_TEXT_TWENTY = 'ยี่';
const BAHT_TEXT_INTEGER = 'ถ้วน';
const BAHT_TEXT_BAHT = 'บาท';
const BAHT_TEXT_SATANG = 'สตางค์';
const BAHT_TEXT_POINT = 'จุด';

class Functions
{
  //https://github.com/ponlawat-w/php-baht_text/blob/master/baht_text.php

  /**
   * Convert baht number to Thai text
   * @param double|int $number
   * @param bool $include_unit
   * @param bool $display_zero
   * @return string|null
   */
  public static function baht_text($number, $include_unit = true, $display_zero = true)
  {
      if(!is_numeric($number))
      {
          return null;
      }
      $log = floor(log($number, 10));
      if($log > 5)
      {
          $millions = floor($log / 6);
          $million_value = pow(1000000, $millions);
          $normalised_million = floor($number / $million_value);
          $rest = $number - ($normalised_million * $million_value);
          $millions_text = '';
          for($i = 0; $i < $millions; $i++)
          {
              $millions_text .= BAHT_TEXT_UNITS[6];
          }
          return self::baht_text($normalised_million, false) . $millions_text . self::baht_text($rest, true, false);
      }
      $number_str = (string)floor($number);
      $text = '';
      $unit = 0;
      if($display_zero && $number_str == '0')
      {
          $text = BAHT_TEXT_NUMBERS[0];
      }
      else for($i = strlen($number_str) - 1; $i > -1; $i--)
      {
          $current_number = (int)$number_str[$i];
          $unit_text = '';
          if($unit == 0 && $i > 0)
          {
              $previous_number = isset($number_str[$i - 1]) ? (int)$number_str[$i - 1] : 0;
              if($current_number == 1 && $previous_number > 0)
              {
                  $unit_text .= BAHT_TEXT_ONE_IN_TENTH;
              }
              else if($current_number > 0)
              {
                  $unit_text .= BAHT_TEXT_NUMBERS[$current_number];
              }
          }
          else if($unit == 1 && $current_number == 2)
          {
              $unit_text .= BAHT_TEXT_TWENTY;
          }
          else if($current_number > 0 && ($unit != 1 || $current_number != 1))
          {
              $unit_text .= BAHT_TEXT_NUMBERS[$current_number];
          }
          if($current_number > 0)
          {
              $unit_text .= BAHT_TEXT_UNITS[$unit];
          }
          $text = $unit_text . $text;
          $unit++;
      }
      if($include_unit)
      {
          $text .= BAHT_TEXT_BAHT;
          $satang = explode('.', number_format($number, 2, '.', ''))[1];
          if($satang == 0)
          {
              $text .= BAHT_TEXT_INTEGER;
          }
          else
          {
              $text .= self::baht_text($satang, false) . BAHT_TEXT_SATANG;
          }
      }
      else
      {
          $exploded = explode('.', $number);
          if(isset($exploded[1]))
          {
              $text .= BAHT_TEXT_POINT;
              $decimal = (string)$exploded[1];
              for($i = 0; $i < strlen($decimal); $i++)
              {
                  $text .= BAHT_TEXT_NUMBERS[$decimal[$i]];
              }
          }
      }
      return $text;
  }

}
