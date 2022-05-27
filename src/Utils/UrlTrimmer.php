<?php declare(strict_types=1);

namespace App\Utils;

class UrlTrimmer
{
    public function trim(string $url): string
    {
        return trim(strrchr($url, '/'), '/');
    }
}
