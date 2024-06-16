<?php

namespace App\Storage\Application\UseCase\Query\FIndFileById;

use App\Shared\Application\Query\QueryHandlerInterface;
use App\Shared\Domain\Security\UserFetcherInterface;
use App\Storage\Domain\Repository\EventFileRepositoryInterface;
use MongoDB\BSON\ObjectId;
use Symfony\Component\HttpFoundation\StreamedResponse;

class FindFileByIdQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly EventFileRepositoryInterface $eventFileRepository,
        private readonly UserFetcherInterface $userFetcher)
    {
    }

    public function __invoke(FindFileByIdQuery $query): StreamedResponse
    {
        $fileIdBSON = new ObjectId($query->fileId);
        $downloadStream = $this->eventFileRepository->getDownloadFileStream($fileIdBSON);
        $response = new StreamedResponse(function () use ($downloadStream) {
            while (!feof($downloadStream)) {
                $buffer = fread($downloadStream, 8192);
                echo $buffer;
                @ob_flush();
                flush();
            }
            fclose($downloadStream);
        });
        var_dump($fileIdBSON);
        var_dump($this->userFetcher->getUser()->getUlid());
        $filename = $this->eventFileRepository->findFileByIdAndCreatorUlid($fileIdBSON, $this->userFetcher->getUser()->getUlid())->filename;

        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="'.$filename.'"');

        return $response;
    }
}
