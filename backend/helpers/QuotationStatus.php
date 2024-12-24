<?php

namespace backend\helpers;

class QuotationStatus
{
    private static $data = [
        '0' => 'Draft',
        '1' => 'Send and Pending',
        '2' => 'Revised',
        '3' => 'Approved',
        '4' => 'Rejected',
    ];

    private static $dataobj = [
        ['id' => '0', 'name' => 'Draft'],
        ['id' => '1', 'name' => 'Send and Pending'],
        ['id' => '2', 'name' => 'Revised'],
        ['id' => '3', 'name' => 'Approved'],
        ['id' => '4', 'name' => 'Rejected'],
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
