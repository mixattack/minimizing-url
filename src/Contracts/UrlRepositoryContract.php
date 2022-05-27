<?php declare(strict_types=1);

namespace App\Contracts;

use App\Entity\Url;

interface UrlRepositoryContract
{
    public function persist(Url $entity): void;

    public function existByMinimizingUrl(string $minimizingUrl): bool;

    public function getByMinimizingUrl(string $minimizingUrl): Url;
}
