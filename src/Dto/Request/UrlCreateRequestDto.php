<?php declare(strict_types=1);

namespace App\Dto\Request;

use DateTime;
use Symfony\Component\Validator\Constraints as Assert;

class UrlCreateRequestDto
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Url()
     */
    public string $url;

    /**
     * @var DateTime
     * @Assert\NotBlank()
     */
    public DateTime $ttl;
}
