<?php

namespace App\Helpers;

class AesHelper
{

    private static function getKey(): string
    {
        return env('AES_KEY');
    }

    private static function getIv(): string
    {
        return env('AES_IV');
    }


    public static function encryptData(string $data): string
    {
        return openssl_encrypt($data, 'AES-256-CBC', self::getKey(), 0, self::getIv());
    }


    public static function decryptData(string $data): string
    {
        return openssl_decrypt($data, 'AES-256-CBC', self::getKey(), 0, self::getIv());
    }
}


