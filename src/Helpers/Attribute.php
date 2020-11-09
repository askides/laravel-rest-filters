<?php

namespace ItsRennyMan\RestFilters\Helpers;

class Attribute 
{
    public static function sobstitute($attribute)
    {
        $hashMap = [
            'gt' => '>',
            'gte' => '>=',
            'lt' => '<',
            'lte' => '<=',
            'like' => 'like',
            'ilike' => 'ilike'
        ];

        return array_key_exists($attribute, $hashMap) ?
            $hashMap[$attribute] :
            false;
    }
}