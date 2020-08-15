<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * The most generic kind of creative work, including books, movies, photographs, software programs, etc.
 *
 * @see http://schema.org/CreativeWork Documentation on Schema.org
 *
 * @ORM\Entity
 * @ApiResource(iri="http://schema.org/CreativeWork")
 */
class CreativeWork
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
     * @var string|null the name of the item
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/name")
     * @Assert\Type(type="string")
     */
    private $name;

    /**
     * @var string|null A sub property of description. A short description of the item used to disambiguate from other, similar items. Information from other properties (in particular, name) may be necessary for the description to be useful for disambiguation.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/disambiguatingDescription")
     * @Assert\Type(type="string")
     */
    private $disambiguatingDescription;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Type(type="string")
     */
    private $abstract;

    /**
     * @var string|null An image of the item. This can be a \[\[URL\]\] or a fully described \[\[ImageObject\]\].
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/image")
     * @Assert\Url
     */
    private $image;


    /**
     * @var string|null The predominant type or kind characterizing the learning resource. For example, 'presentation', 'handout'.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/learningResourceType")
     * @Assert\Type(type="string")
     */
    private $learningResourceType;

    /**
     * @var string|null The language of the content or performance or used in an action. Please use one of the language codes from the \[IETF BCP 47 standard\](http://tools.ietf.org/html/bcp47). See also \[\[availableLanguage\]\].
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/inLanguage")
     * @Assert\Type(type="string")
     */
    private $inLanguage;

    /**
     * @var MediaObject|null A media object that encodes this CreativeWork. This property is a synonym for associatedMedia.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\MediaObject")
     * @ApiProperty(iri="http://schema.org/encoding")
     */
    private $encoding;

    /**
     * @var videoObject |null An embedded video object
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\VideoObject")
     * @ApiProperty(iri="http://schema.org/video")
     */
    private $video;

    /**
    * @var Collection<Person>|null A maintainer is a Person that manages contributions to, and/or publication of, some (typically complex) artifact.
    *
    * @ORM\ManyToMany(targetEntity="App\Entity\Person", inversedBy="maintainerOf")
    * @ApiProperty(iri="http://schema.org/maintainer")
    */
    private $maintainers;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=300, unique=true)
     * @ApiProperty(identifier=true)
     */
    private $slug;

    public function __construct()
    {
        $this->maintainers = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setDisambiguatingDescription(?string $disambiguatingDescription): void
    {
        $this->disambiguatingDescription = $disambiguatingDescription;
    }

    public function getDisambiguatingDescription(): ?string
    {
        return $this->disambiguatingDescription;
    }

    public function setAbstract(?string $abstract): void
    {
        $this->abstract = $abstract;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setLearningResourceType(?string $learningResourceType): void
    {
        $this->learningResourceType = $learningResourceType;
    }

    public function getLearningResourceType(): ?string
    {
        return $this->learningResourceType;
    }

    public function setInLanguage(?string $inLanguage): void
    {
        $this->inLanguage = $inLanguage;
    }

    public function getInLanguage(): ?string
    {
        return $this->inLanguage;
    }

    public function setEncoding(?MediaObject $encoding): void
    {
        $this->encoding = $encoding;
    }

    public function getEncoding(): ?MediaObject
    {
        return $this->encoding;
    }

    /**
     * @param VideoObject |null $video
     */
    public function setVideo($video): void
    {
        $this->video = $video;
    }

    /**
     * @return VideoObject |null
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @return Collection|Person[]
     */
    public function getMaintainers(): Collection
    {
        return $this->maintainers;
    }

    public function addMaintainer(Person $maintainer): self
    {
        if (!$this->maintainers->contains($maintainer)) {
            $this->maintainers[] = $maintainer;
        }

        return $this;
    }

    public function removeMaintainer(Person $maintainer): self
    {
        if ($this->maintainers->contains($maintainer)) {
            $this->maintainers->removeElement($maintainer);
        }

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }
}
