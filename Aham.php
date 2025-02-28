<?php

/**
 * Tool pentru integrare cu aham.ro
 */

namespace Aham;

class Picture {
    public function __construct(string $path) {

    }

    public function ready() {
        return true;
    }
}

class Api {

    public const URL = 'https://api.aham.ro/v1';

    private string $key;

    public function __construct(string $key) {
        $this->key = $key;
    }

    /**
     * Crează un anunț nou
     */
    public function create(string $title, string $description, array $pictures) {
        
        if (!isset($title) || $title == '') {
            throw new \InvalidArgumentException("Este musai sa specifici titlul");
        }

        if (!isset($description) || $description == '') {
            throw new \InvalidArgumentException("Este musai sa specifici descrierea");
        }

        foreach ($pictures as $picture) {

            if (!$picture instanceof Picture) {
                throw new \InvalidArgumentException("Pictures must be instances of Picture class.");
            }

            if (!$picture->ready()) {
                throw new \Exception("Picture is not ready");
            }
        }

        $payload = array(
            "title" =>  $title,
            "description" => $description,
            "pictures" => $pictures,
        );

        $headers = array(
            "Content-Type" => "application/json",
            "Authorization" => "Bearer " . $this->key,
            "User-Agent" => "AhamSdk/1.0"
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, self::URL . '/ads');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_USERAGENT, "AhamSdk/1.0");

        // Execute request and get response
        $response = curl_exec($ch);

        // Check for errors
        if (curl_errno($ch)) {
            throw new \Exception('cURL Error: ' . curl_error($ch));
        }

        // Get HTTP status code
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($statusCode === 403) {
            throw new \Exception('Ai nevoie de o cheie validă');
        }

        if ($statusCode === 401) {
            throw new \Exception('Ai nevoie de o cheie validă');
        }

        // todo
    }
}
