<?php declare(strict_types=1);

namespace App\Service;

use App\Contracts\MinimizationUrlContract;
use App\Contracts\UrlRepositoryContract;
use App\Contracts\UrlServiceContract;
use App\Dto\Request\UrlCreateRequestDto;
use App\Dto\Request\UrlStatisticRequestDto;
use App\Entity\Url;
use App\Exception\InActiveException;
use App\Utils\Flusher;
use App\Utils\UrlTrimmer;
use Ramsey\Uuid\Uuid;

class UrlService implements UrlServiceContract
{
    public function __construct(
        private UrlRepositoryContract $repository,
        private MinimizationUrlContract $minimizator,
        private Flusher $flusher,
        private UrlTrimmer $trimmer
    ) {}

    public function create(UrlCreateRequestDto $request): Url
    {
        do {
            $minimizedUrl = $this->minimizator->minimizing();
        } while ($this->repository->existByMinimizingUrl($minimizedUrl) === true);

        $entity = new Url(
            Uuid::uuid4(),
            $request->url,
            $minimizedUrl,
            $request->ttl,
            0
        );
        $this->repository->persist($entity);

        $this->flusher->flush();

        return $entity;
    }

    public function redirect(string $url): string
    {
        $entity = $this->repository->getByMinimizingUrl($url);

        if ($entity->checkTtl()) {
            throw new InActiveException('Url is not active');
        }

        $entity->visited();
        $this->flusher->flush();

        return $entity->getUrl();
    }

    public function statistic(UrlStatisticRequestDto $request): Url
    {
        return $this->repository->getByMinimizingUrl($this->trimmer->trim($request->url));
    }
}
