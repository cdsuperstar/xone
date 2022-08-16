<?php
namespace App\Helper;

class Helper
{
    public static function checkIdcard($num = '')
    {
        $length = strlen($num);
        if ($length == 15) { //如果是15位身份证

            //15位身份证没有字母
            if (!is_numeric($num)) {
                return false;
            }
            // 省市县（6位）
            $areaNum = substr($num, 0, 6);
            // 出生年月（6位）
            $dateNum = substr($num, 6, 6);
        } else if ($length == 18) { //如果是18位身份证

            //基本格式校验
            if (!preg_match('/^\d{17}[0-9xX]$/', $num)) {
                return false;
            }
            // 省市县（6位）
            $areaNum = substr($num, 0, 6);
            // 出生年月日（8位）
            $dateNum = substr($num, 6, 8);
        } else { //假身份证
            return false;
        }

        $provinceCode = substr($areaNum, 0, 2);

        // 根据GB/T2260—999，省市代码11到65
        if (11 > $provinceCode || $provinceCode > 65) {
            return false;
        }

        //验证日期
        if (strlen($dateNum) == 6) { //15位身份证号没有年份，这里拼上年份
            $dateNum = '19' . $dateNum;
        }
        $year = intval(substr($dateNum, 0, 4));
        $month = intval(substr($dateNum, 4, 2));
        $day = intval(substr($dateNum, 6, 2));

        //日期基本格式校验
        if (!checkdate($month, $day, $year)) {
            return false;
        }

        //日期格式正确，但是逻辑存在问题(如:年份大于当前年)
        $currYear = date('Y');
        if ($year > $currYear) {
            return false;
        }

        //验证最后一位
        if (strlen($num) == 18) {
            $factor = [7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2];
            $tokens = ['1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2'];

            $checkSum = 0;
            for ($i = 0; $i < 17; $i++) {
                $checkSum += intval($num[$i]) * $factor[$i];
            }

            $mod = $checkSum % 11;
            $token = $tokens[$mod];

            $lastChar = strtoupper($num[17]);

            if ($lastChar != $token) {
                return false;
            }
        }
        return true;
    }
}

?>
