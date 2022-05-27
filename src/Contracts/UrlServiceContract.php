<?php declare(strict_types=1);

namespace App\Contracts;

use App\Dto\Request\UrlCreateRequestDto;
use App\Dto\Request\UrlStatisticRequestDto;
use App\Entity\Url;

interface UrlServiceContract
{
    public function create(UrlCreateRequestDto $request): Url;

    public function redirect(string $url): string;

    public function statistic(UrlStatisticRequestDto $request): Url;
}
