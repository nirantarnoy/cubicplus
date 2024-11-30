<?php

namespace backend\helpers;

class LogType
{
    private static $data = [
        '0' => 'All',
        '1' => 'Access log',
        '2' => 'Error log',
        '3' => 'Audit log'
    ];

    private static $dataobj = [
        ['id'=>'0','name' => 'All'],
        ['id'=>'1','name' => 'Access log'],
        ['id'=>'2','name' => 'Error log'],
        ['id'=>'3','name' => 'Audit log'],
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
