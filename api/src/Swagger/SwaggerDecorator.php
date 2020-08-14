<?php
// src/Swagger/SwaggerDecorator.php

namespace App\Swagger;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class SwaggerDecorator implements NormalizerInterface
{
    private $decorated;

    public function __construct(NormalizerInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $docs = $this->decorated->normalize($object, $format, $context);

        // If a prefix is configured on API Platform's routes, it must appear here.
        unset($docs['paths']['/places']);
        unset($docs['paths']['/places/{id}']);
        unset($docs['paths']['/postal_addresses']);
        unset($docs['paths']['/postal_addresses/{id}']);

        // Override title
        $docs['info']['title'] = 'Decentralised network for developers API';

        return $docs;
    }

    public function supportsNormalization($data, $format = null)
    {
        return $this->decorated->supportsNormalization($data, $format);
    }
}
