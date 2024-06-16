<?php

namespace App\Shared\Application\ArgumentResolver;

use App\Shared\Application\Attribute\RequestFile;
use App\Shared\Application\DTO\FileModel;
use App\Shared\Application\Exception\ValidationException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RequestFileArgumentResolver implements ValueResolverInterface
{
    public function __construct(private readonly ValidatorInterface $validator)
    {
    }

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        if (!$argument->getAttributesOfType(RequestFile::class, ArgumentMetadata::IS_INSTANCEOF)) {
            return [];
        }

        $constraints = new Assert\File([
            'maxSize' => '100M',
            'mimeTypes' => [
                'image/jpeg',
                'image/png',
                'application/pdf',
                'text/plain',
                'application/msword', // MIME-тип для .doc файлов
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // MIME-тип для .docx файлов
                'video/mp4',
                'video/quicktime',
                'video/x-msvideo',
                'video/x-matroska',
                'audio/mpeg',
                'audio/wav',
                'audio/ogg',
                'audio/aac',
            ],
            'mimeTypesMessage' => 'Please upload a valid file (JPEG, PNG, PDF, TXT, DOC, DOCX, MP4, MOV, AVI, MKV, MP3, WAV, OGG, AAC)',
        ]);

        /**
         * @var UploadedFile $file
         */
        $file = $request->files->get('file');
        $errors = $this->validator->validate($file, $constraints);
        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }
        $class = new \ReflectionClass($argument->getType());
        /**
         * @var FileModel $model
         */
        $model = $class->newInstance($file);

        return [$model];
    }
}
