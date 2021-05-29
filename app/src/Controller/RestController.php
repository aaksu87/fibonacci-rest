<?php

namespace App\Controller;

use App\Service\MathService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestController extends AbstractController
{
    private MathService $mathService;
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, MathService $mathService)
    {
        $this->mathService = $mathService;
        $this->logger = $logger;
    }

    /**
     * @Route("/nth-fibonacci/{nth}", name="nth_fibonacci", requirements = {"nth": "\d+"})
     * @param int $nth
     * @return JsonResponse
     */
    public function getNthFibonacci(int $nth): JsonResponse
    {
        try {

            return new JsonResponse($this->mathService->getNumber($nth));

        } catch (\Exception $e) {
            $this->logger->error('Error: ' . $e->getMessage());
            return (new JsonResponse('Something is wrong', Response::HTTP_BAD_REQUEST))->send();
        }

    }
}
