<?php declare(strict_types=1);

namespace App\Controller;

use App\Contracts\UrlServiceContract;
use App\Dto\Request\UrlCreateRequestDto;
use App\Dto\Request\UrlStatisticRequestDto;
use App\Exception\InActiveException;
use App\Exception\NotFoundException;
use App\Form\UrlCreateForm;
use App\Form\UrlStatisticForm;
use App\Transformer\UrlTransformer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UrlController extends AbstractController
{
    public function __construct(protected UrlServiceContract $service, protected UrlTransformer $transformer)
    {}

    /**
     * @Route("/", name="home")
    */
    public function index(Request $request): Response
    {
        $dto = new UrlCreateRequestDto();
        $form = $this->createForm(UrlCreateForm::class, $dto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity = $this->service->create($dto);
            $result = $this->transformer->dtoFromEntity($entity);

            return $this->render(
                'result.create.html.twig',
                [
                    'minimizing_url' => $result->urlMinimizing
                ]
            );
        }

        return $this->renderForm('create.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("{url}")
     */
    public function move(string $url): Response
    {
        try {
            return $this->redirect($this->service->redirect($url));
        } catch (InActiveException $e) {
            $this->addFlash('error', $e->getMessage());
        } catch (NotFoundException $e) {
            $this->addFlash('error', $e->getMessage());
        }

        return $this->redirect('/');
    }

    /**
     * @Route("/statistic", name="statistic", priority=1)
     */
    public function statistic(Request $request): Response
    {
        $dto = new UrlStatisticRequestDto();
        $form = $this->createForm(UrlStatisticForm::class, $dto);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $entity = $this->service->statistic($dto);
                $result = $this->transformer->dtoFromEntity($entity);

                return $this->render(
                    'result.statistic.html.twig',
                    [
                        'result' => $result
                    ]
                );
            } catch (NotFoundException $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }

        return $this->renderForm('statistic.html.twig', [
            'form' => $form,
        ]);
    }
}
