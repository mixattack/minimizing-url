<?php declare(strict_types=1);

namespace App\Dto\Request;

use Symfony\Component\Validator\Constraints as Assert;

class UrlStatisticRequestDto
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Url()
     */
    public string $url;
}
