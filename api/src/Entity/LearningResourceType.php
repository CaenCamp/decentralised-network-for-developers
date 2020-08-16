<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Repository\LearningResourceTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * The predominant type or kind characterizing the learning resource. For example, 'presentation', 'handout'.
 *
 * @see https://schema.org/learningResourceType Documentation on Schema.org
 *
 * @ORM\Entity
 * @ApiResource(
 *  iri="http://schema.org/learningResourceType",
 *  attributes={"order"={"name": "ASC"}}
 * )
 * @ApiFilter(
 *  OrderFilter::class,
 *  properties={"name", "typeFor",},
 *  arguments={"orderParameterName"="order"}
 * )
 */
class LearningResourceType
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
     * @ORM\Column(type="string", length=255)
     * @ApiProperty(iri="http://schema.org/name")
     * @Assert\Type(type="string")
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=300, unique=true)
     * @ApiProperty(identifier=true)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * @ApiFilter(SearchFilter::class, strategy="exact")
     */
    private $typeFor;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $abstract;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CreativeWork", mappedBy="learningResourceType")
     * @ApiProperty(iri="http://schema.org/CreativeWork")
     */
    private $creativeWorks;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CreativeWorkMaterial", mappedBy="learningResourceType")
     * @ApiProperty(iri="http://schema.org/MediaObject")
     */
    private $creativeWorkMaterials;

    public function __construct()
    {
        $this->creativeWorks = new ArrayCollection();
        $this->creativeWorkMaterials = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    public function getTypeFor(): ?string
    {
        return $this->typeFor;
    }

    public function setTypeFor(string $typeFor): self
    {
        $this->typeFor = $typeFor;

        return $this;
    }

    public function getAbstract(): ?string
    {
        return $this->abstract;
    }

    public function setAbstract(?string $abstract): self
    {
        $this->abstract = $abstract;

        return $this;
    }

    /**
     * @return Collection|CreativeWork[]
     */
    public function getCreativeWorks(): Collection
    {
        return $this->creativeWorks;
    }

    public function addCreativeWork(CreativeWork $creativeWork): self
    {
        if (!$this->creativeWorks->contains($creativeWork)) {
            $this->creativeWorks[] = $creativeWork;
            $creativeWork->setLearningResourceType($this);
        }

        return $this;
    }

    public function removeCreativeWork(CreativeWork $creativeWork): self
    {
        if ($this->creativeWorks->contains($creativeWork)) {
            $this->creativeWorks->removeElement($creativeWork);
            // set the owning side to null (unless already changed)
            if ($creativeWork->getLearningResourceType() === $this) {
                $creativeWork->setLearningResourceType(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|CreativeWorkMaterial[]
     */
    public function getCreativeWorkMaterials(): Collection
    {
        return $this->creativeWorkMaterials;
    }

    public function addCreativeWorkMaterial(CreativeWorkMaterial $creativeWorkMaterial): self
    {
        if (!$this->creativeWorkMaterials->contains($creativeWorkMaterial)) {
            $this->creativeWorkMaterials[] = $creativeWorkMaterial;
            $creativeWorkMaterial->setLearningResourceType($this);
        }

        return $this;
    }

    public function removeCreativeWorkMaterial(CreativeWorkMaterial $creativeWorkMaterial): self
    {
        if ($this->creativeWorkMaterials->contains($creativeWorkMaterial)) {
            $this->creativeWorkMaterials->removeElement($creativeWorkMaterial);
            // set the owning side to null (unless already changed)
            if ($creativeWorkMaterial->getLearningResourceType() === $this) {
                $creativeWorkMaterial->setLearningResourceType(null);
            }
        }

        return $this;
    }
}
