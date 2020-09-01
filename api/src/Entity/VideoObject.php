<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A video file.
 *
 * @see http://schema.org/VideoObject Documentation on Schema.org
 *
 * @ORM\Entity
 * @ApiResource(iri="http://schema.org/VideoObject")
 */
class VideoObject
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
     * @Groups({"talk"})
     */
    private $abstract;

    /**
     * @var string|null actual bytes of the media object, for example the image file or video file
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * @Assert\Url
     * @Groups({"talk"})
     */
    private $contentUrl;

    /**
     * @var string|null A URL pointing to a player for a specific video. In general, this is the information in the ```src``` element of an ```embed``` tag and should not be the same as the content of the ```loc``` tag.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/embedUrl")
     * @Assert\Url
     * @Groups({"talk"})
     */
    private $embedUrl;

    /**
     * @var Event|null The Event where the CreativeWork was recorded. The CreativeWork may capture all or part of the event.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Event", inversedBy="recordedIn")
     * @ORM\JoinColumn(nullable=true)
     * @ApiProperty(iri="http://schema.org/recordedAt")
     */
    private $recordedAt;

    /**
    * @var CreativeWork|null the CreativeWork encoded by this media object
    *
    * @ORM\ManyToOne(targetEntity="App\Entity\CreativeWork", inversedBy="videos")
    * @ORM\JoinColumn(nullable=false)
    * @ApiProperty(iri="http://schema.org/encodesCreativeWork")
    * @ApiFilter(SearchFilter::class, strategy="exact")
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

    public function setContentUrl(?string $contentUrl): void
    {
        $this->contentUrl = $contentUrl;
    }

    public function getContentUrl(): ?string
    {
        return $this->contentUrl;
    }

    public function setEmbedUrl(?string $embedUrl): void
    {
        $this->embedUrl = $embedUrl;
    }

    public function getEmbedUrl(): ?string
    {
        return $this->embedUrl;
    }

    public function setRecordedAt(?Event $recordedAt): void
    {
        $this->recordedAt = $recordedAt;
    }

    public function getRecordedAt(): ?Event
    {
        return $this->recordedAt;
    }

    public function getEncodesCreativeWork(): ?CreativeWork
    {
        return $this->encodesCreativeWork;
    }

    public function setEncodesCreativeWork(?CreativeWork $encodesCreativeWork): self
    {
        $this->encodesCreativeWork = $encodesCreativeWork;

        return $this;
    }
}
