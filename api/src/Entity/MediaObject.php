<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A media object, such as an image, video, or audio object embedded in a web page or a downloadable dataset i.e. DataDownload. Note that a creative work may have many media objects associated with it on the same web page. For example, a page about a single song (MusicRecording) may have a music video (VideoObject), and a high and low bandwidth audio stream (2 AudioObject's).
 *
 * @see http://schema.org/MediaObject Documentation on Schema.org
 *
 * @ORM\Entity
 * @ApiResource(iri="http://schema.org/MediaObject")
 */
class MediaObject
{
    /**
     * @var string|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     * @Assert\Uuid
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Type(type="string")
     */
    private $abstract;

    /**
     * @var string|null The predominant type or kind characterizing the learning resource. For example, 'presentation', 'handout'.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/learningResourceType")
     * @Assert\Type(type="string")
     */
    private $learningResourceType;

    /**
     * @var string|null actual bytes of the media object, for example the image file or video file
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * @Assert\Url
     */
    private $contentUrl;

    /**
     * @var CreativeWork|null the CreativeWork encoded by this media object
     *
     * @ORM\OneToOne(targetEntity="App\Entity\CreativeWork")
     * @ApiProperty(iri="http://schema.org/encodesCreativeWork")
     */
    private $encodesCreativeWork;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setAbstract(?string $abstract): void
    {
        $this->abstract = $abstract;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setLearningResourceType(?string $learningResourceType): void
    {
        $this->learningResourceType = $learningResourceType;
    }

    public function getLearningResourceType(): ?string
    {
        return $this->learningResourceType;
    }

    public function setContentUrl(?string $contentUrl): void
    {
        $this->contentUrl = $contentUrl;
    }

    public function getContentUrl(): ?string
    {
        return $this->contentUrl;
    }

    public function setEncodesCreativeWork(?CreativeWork $encodesCreativeWork): void
    {
        $this->encodesCreativeWork = $encodesCreativeWork;
    }

    public function getEncodesCreativeWork(): ?CreativeWork
    {
        return $this->encodesCreativeWork;
    }
}
