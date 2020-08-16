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
 * A CreativeWorkMaterial aka media object, such as a slide, git repo, pdf ... object embedded in a web page or a downloadable dataset i.e. DataDownload. Note that a creative work may have many media objects associated with it on the same web page..
 *
 * @see http://schema.org/MediaObject Documentation on Schema.org
 *
 * @ORM\Entity
 * @ApiResource(iri="http://schema.org/MediaObject")
 */
class CreativeWorkMaterial
{
    /**
     * @var string|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     * @Assert\Uuid
     * @Groups({"talk"})
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
    * @var CreativeWork|null the CreativeWork encoded by this media object
    *
    * @ORM\ManyToOne(targetEntity="App\Entity\CreativeWork", inversedBy="materials")
    * @ORM\JoinColumn(nullable=false)
    * @ApiProperty(iri="http://schema.org/encodesCreativeWork")
    * @ApiFilter(SearchFilter::class, strategy="exact")
    * @Groups({"talk"})
    */
    private $encodesCreativeWork;

    /**
     * @var LearningResourceType|null The predominant type or kind characterizing the learning resource. For example, 'presentation', 'handout'.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\LearningResourceType", inversedBy="creativeWorkMaterials")
     * @ORM\JoinColumn(nullable=false)
     * @ApiProperty(iri="http://schema.org/learningResourceType")
     * @Groups({"talk"})
     */
    private $learningResourceType;

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

    public function getEncodesCreativeWork(): ?CreativeWork
    {
        return $this->encodesCreativeWork;
    }

    public function setEncodesCreativeWork(?CreativeWork $encodesCreativeWork): self
    {
        $this->encodesCreativeWork = $encodesCreativeWork;

        return $this;
    }

    public function getLearningResourceType(): ?LearningResourceType
    {
        return $this->learningResourceType;
    }

    public function setLearningResourceType(?LearningResourceType $learningResourceType): self
    {
        $this->learningResourceType = $learningResourceType;

        return $this;
    }
}
