<?php
namespace core;

class Validator {
    public static function string($value, $min = 1, $max = 1000) {
        $value = trim($value);
        return strlen($value) >= $min && strlen($value) <= $max;
    }


    public static function email(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL);
    }

}