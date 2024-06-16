<?php

namespace App\Data\Infrastructure\Http\Controller;

use App\Data\Application\DTO\DataRequestDTO;
use App\Data\Application\Service\DataPublishService;
use App\Data\Application\Service\DataReturnService;
use App\Data\Application\Service\DistributionService;
use App\Data\Application\Service\ServerQueryService;
use App\Data\Infrastructure\Service\FileHandlerService;
use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\Attribute\RequestFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DataController extends AbstractController
{
    public function __construct(
        private readonly DataPublishService $dataPublishService,
        private readonly DistributionService $distributionService,
        )
    {
    }



    #[Route(path: '/main-server/v1/insert/data',methods: ['POST'])]
    public function insert(#[RequestBody]DataRequestDTO $dataRequestDTO): Response
    {
        $this->dataPublishService->publish($dataRequestDTO);
        return $this->json('success');
    }
    #[Route(path: '/main-server/v1/distribution/data',methods: ['GET'])]
    public function distribution(): Response
    {
        $this->distributionService->distribution();

        return $this->json('success');
    }
    #[Route(path: '/main-server/v1/data/all',methods: ['GET'])]
    public function allData(DataReturnService $dataReturnService, ServerQueryService $queryService): Response
    {

        return $this->json([$dataReturnService->data(),$queryService->getServer1AllData()]);
    }

    #[Route(path: '/main-server/v1/api/upload',methods: ['POST'])]
    public function fileLoad(#[RequestFile]FileHandlerService $fileHandlerService): Response
    {
        $file =  $fileHandlerService->getModelFile();
        $fileDTOs = $this->distributionService->distributionFile($file);

        $this->dataPublishService->publishPart1File($fileDTOs[0]);
        $this->dataPublishService->publishPart2File($fileDTOs[1]);

        return $this->json('success');
    }
}