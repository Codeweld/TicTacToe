<?php

declare(strict_types=1);

namespace App\Infrastructure\Serializer;

use App\Application\SerializerInterface;
use Symfony\Component\Serializer\SerializerInterface as BaseSerializerInterface;
use Symfony\Component\Serializer\Serializer as BaseSerializer;

final class Serializer implements SerializerInterface
{
    /** @var BaseSerializerInterface&BaseSerializer */
    private BaseSerializerInterface $serializer;

    public function __construct(
        BaseSerializerInterface $serializer,
    ) {
        $this->serializer = $serializer;
    }

    public function normalize($data, $format = null, array $context = [])
    {
        return $this->serializer->normalize($data, $format, $context);
    }

    public function denormalize($data, $type, $format = null, array $context = [])
    {
        return $this->serializer->denormalize($data, $type, $format, $context);
    }
}
