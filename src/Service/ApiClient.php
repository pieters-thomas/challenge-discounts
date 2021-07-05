<?php


namespace App\Service;


abstract class ApiClient
{
    protected const API = '/var/www/becode/challenge-discounts/json';

    /**
     * @throws \JsonException
     */
    public function apiRequest(string $path): array
    {
        $json = file_get_contents(self::API.$path);
        return json_decode($json, true, 512, JSON_THROW_ON_ERROR);
    }
}
