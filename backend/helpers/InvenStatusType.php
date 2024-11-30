<?php

namespace backend\helpers;

class InvenStatusType
{
    private static $data = [
        '0' => 'ว่าง',
        '1' => 'ไม่ว่าง(ยืมสินค้า POC)',
        '2' => 'จำหน่ายออก(ARS)',
        '3' => 'จำหน่ายออก(เคลมสินค้า)'
    ];

    private static $dataobj = [
        ['id'=>'0','name' => 'ว่าง'],
        ['id'=>'1','name' => 'ไม่ว่าง(ยืมสินค้า POC)'],
        ['id'=>'2','name' => 'จำหน่ายออก(ARS)'],
        ['id'=>'3','name' => 'จำหน่ายออก(เคลมสินค้า)'],
    ];
    public static function asArray()
    {
        return self::$data;
    }
    public static function asArrayObject()
    {
        return self::$dataobj;
    }
    public static function getTypeById($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown Type';
    }
    public static function getTypeByName($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown Type';
    }
}
