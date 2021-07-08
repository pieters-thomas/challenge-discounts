<?php


namespace App\Service\API;


use Exception;

abstract class ApiClient
{
    protected const API = '/var/www/becode/challenge-discounts/json';


    /**
     * @throws Exception
     */
    public function apiRequest(string $path): array
    {
        try {
            $json = file_get_contents(self::API.$path);
            return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
        }catch (Exception)
        {
            throw new Exception("json request failed");
        }
    }
}
