<?php

namespace App\Transformer\Dto;

class UrlDto
{
    public function __construct(
        public string $url,
        public string $urlMinimizing,
        public string $ttl,
        public int $count
    ) {}
}