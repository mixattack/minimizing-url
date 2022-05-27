<?php declare(strict_types=1);

namespace App\Utils;

use Doctrine\ORM\EntityManagerInterface;

class Flusher
{
    public function __construct(private EntityManagerInterface $_em)
    {}

    public function flush(): void
    {
        $this->_em->flush();
    }
}
