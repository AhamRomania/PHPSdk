<?php

/**
 * Tool pentru integrare cu aham.ro
 */

namespace Aham;

class Picture {
    public function __construct(string $path) {

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
        
        foreach ($pictures as $picture) {
            if (!$picture instanceof Picture) {
                throw new \InvalidArgumentException("Pictures must be instances of Picture class.");
            }
        }

        // upload pictures on cdn.aham.ro
        // create new add on api.aham.ro
    }
}
