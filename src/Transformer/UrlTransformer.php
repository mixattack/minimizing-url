<?php declare(strict_types=1);

namespace App\Transformer;

use App\Entity\Url;
use App\Transformer\Dto\UrlDto;

class UrlTransformer
{
    public function dtoFromEntity(Url $entity): UrlDto
    {
        return new UrlDto(
            $entity->getUrl(),
            $entity->getMinimizingUrl(),
            $entity->getTtl()->format("Y-m-d H:i:s"),
            $entity->getCount()
        );
    }
}
