<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The most generic kind of creative work, including books, movies, photographs, software programs, etc.
 *
 * @see http://schema.org/CreativeWork Documentation on Schema.org
 *
 * @ORM\Entity
 * @ApiResource(
 *  iri="http://schema.org/CreativeWork",
 *  attributes={"order"={"name": "ASC"}}
 * )
 * @ApiFilter(
 *  OrderFilter::class,
 *  properties={"name", "learningResourceType", "inLanguage"},
 *  arguments={"orderParameterName"="order"}
 * )
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
     * @ApiProperty(identifier=false)
     */
    private $id;

    /**
     * @var string|null the name of the item
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/name")
     * @Assert\Type(type="string")
     * @Groups({"talk"})
     */
    private $name;

    /**
     * @var string|null A sub property of description. A short description of the item used to disambiguate from other, similar items. Information from other properties (in particular, name) may be necessary for the description to be useful for disambiguation.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/disambiguatingDescription")
     * @Assert\Type(type="string")
     * @Groups({"talk"})
     */
    private $disambiguatingDescription;

    /**
     * @var string|null
     *
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Type(type="string")
     * @Groups({"talk"})
     */
    private $abstract;

    /**
     * @var string|null An image of the item. This can be a \[\[URL\]\] or a fully described \[\[ImageObject\]\].
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/image")
     * @Assert\Url
     * @Groups({"talk"})
     */
    private $image;

    /**
     * @var string|null The language of the content or performance or used in an action. Please use one of the language codes from the \[IETF BCP 47 standard\](http://tools.ietf.org/html/bcp47). See also \[\[availableLanguage\]\].
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/inLanguage")
     * @Assert\Type(type="string")
     * @Groups({"talk"})
     */
    private $inLanguage;

    /**
    * @var Collection<Person>|null A maintainer is a Person that manages contributions to, and/or publication of, some (typically complex) artifact.
    *
    * @ORM\ManyToMany(targetEntity="App\Entity\Person", inversedBy="maintainerOf")
    * @ApiProperty(iri="http://schema.org/maintainer")
    * @Groups({"talk"})
    */
    private $maintainers;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=300, unique=true)
     * @ApiProperty(identifier=true)
     */
    private $slug;

    /**
     * @var Collection<CreativeWorkMaterial>|null A material that encodes this CreativeWork. This property is a synonym for associatedMedia.
     *
     * @ORM\OneToMany(
     *      targetEntity="App\Entity\CreativeWorkMaterial",
     *      mappedBy="encodesCreativeWork",
     *      cascade={"persist", "remove"},
     *      orphanRemoval=true
     * )
     * @ApiProperty(iri="http://schema.org/encoding")
     * @Groups({"talk"})
     */
    private $materials;

    /**
     * @var Collection<VideoObject> |null A collection of videos object about the creative work
     *
     * @ORM\OneToMany(
     *      targetEntity="App\Entity\VideoObject",
     *      mappedBy="encodesCreativeWork",
     *      cascade={"persist", "remove"},
     *      orphanRemoval=true
     * )
     * @ApiProperty(iri="http://schema.org/video")
     * @Groups({"talk"})
     */
    private $videos;

    /**
     * @var LearningResourceType|null The predominant type or kind characterizing the learning resource. For example, 'presentation', 'handout'.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\LearningResourceType", inversedBy="creativeWorks")
     * @ORM\JoinColumn(nullable=false)
     * @ApiProperty(iri="http://schema.org/learningResourceType")
     * @Groups({"talk"})
     */
    private $learningResourceType;

    /**
     * @var Collection<Event>|null A collection of Events where the CreativeWork has been performed
     *
     * @ORM\ManyToMany(
     *      targetEntity="App\Entity\Event",
     *      inversedBy="worksPerformed"
     * )
     */
    private $performedInEvents;

    public function __construct()
    {
        $this->maintainers = new ArrayCollection();
        $this->materials = new ArrayCollection();
        $this->videos = new ArrayCollection();
        $this->performedIn = new ArrayCollection();
    }

    /**
     * @return Collection|Event[]
     */
    public function getPerformedInEvents(): Collection
    {
        return $this->performedInEvents;
    }

    public function addPerformedInEvent(Event $event): self
    {
        if (!$this->performedInEvents->contains($event)) {
            $this->performedInEvents[] = $event;
        }

        return $this;
    }

    public function removePerformedInEvent(Event $event): self
    {
        if ($this->performedInEvents->contains($event)) {
            $this->performedInEvents->removeElement($event);
        }

        return $this;
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

    public function setInLanguage(?string $inLanguage): void
    {
        $this->inLanguage = $inLanguage;
    }

    public function getInLanguage(): ?string
    {
        return $this->inLanguage;
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

    /**
     * @return Collection|CreativeWorkMaterial[]
     */
    public function getMaterials(): Collection
    {
        return $this->materials;
    }

    public function addMaterial(CreativeWorkMaterial $material): self
    {
        if (!$this->materials->contains($material)) {
            $this->materials[] = $material;
            $material->setEncodesCreativeWork($this);
        }

        return $this;
    }

    public function removeMaterial(CreativeWorkMaterial $material): self
    {
        if ($this->materials->contains($material)) {
            $this->materials->removeElement($material);
            // set the owning side to null (unless already changed)
            if ($material->getEncodesCreativeWork() === $this) {
                $material->setEncodesCreativeWork(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VideoObject[]
     */
    public function getVideos(): Collection
    {
        return $this->videos;
    }

    public function addVideo(VideoObject $video): self
    {
        if (!$this->videos->contains($video)) {
            $this->videos[] = $video;
            $video->setEncodesCreativeWork($this);
        }

        return $this;
    }

    public function removeVideo(VideoObject $video): self
    {
        if ($this->videos->contains($video)) {
            $this->videos->removeElement($video);
            // set the owning side to null (unless already changed)
            if ($video->getEncodesCreativeWork() === $this) {
                $video->setEncodesCreativeWork(null);
            }
        }

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
