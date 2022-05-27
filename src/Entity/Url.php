<?php declare(strict_types=1);

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UrlRepository")
 * @ORM\Table(
 *     uniqueConstraints={@ORM\UniqueConstraint(name="minimizing_url_unique_idx", columns={"minimizing_url"})}
 * )
 */
class Url
{
    public function __construct(
        /**
         * @var UuidInterface
         * @ORM\Id
         * @ORM\Column(
         *     type="uuid",
         *     unique=true
         * )
         * @ORM\GeneratedValue(strategy="CUSTOM")
         * @ORM\CustomIdGenerator(class="Ramsey\Uuid\Doctrine\UuidGenerator")
         */
        protected UuidInterface $id,

        /**
         * @ORM\Column(type="text")
         */
        protected string $url,

        /**
         * @ORM\Column(type="string", unique=true)
         */
        protected string $minimizingUrl,

        /**
         * @ORM\Column(type="datetime", nullable=true)
         */
        protected ?DateTime $ttl,

        /**
         * @ORM\Column(type="integer")
         */
        protected int $count
    ) {}

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getMinimizingUrl(): string
    {
        return $this->minimizingUrl;
    }

    /**
     * @return DateTime
     */
    public function getTtl(): DateTime
    {
        return $this->ttl;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    public function setCount(int $count): void
    {
        $this->count = $count;
    }

    public function checkTtl(): bool
    {
        return $this->ttl->getTimestamp() < (new DateTime())->getTimestamp();
    }

    public function visited(): void
    {
        $this->count++;
    }
}
