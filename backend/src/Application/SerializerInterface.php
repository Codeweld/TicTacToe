<?php

declare(strict_types=1);

namespace App\Application;

interface SerializerInterface
{
    public function normalize($data, $format = null, array $context = []);

    public function denormalize($data, $type, $format = null, array $context = []);
}
