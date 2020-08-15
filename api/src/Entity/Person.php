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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A person (alive, dead, undead, or fictional).
 *
 * @see http://schema.org/Person Documentation on Schema.org
 *
 * @ORM\Entity
 * @ApiResource(
 *  iri="http://schema.org/Person",
 *  attributes={"order"={"familyName": "ASC"}}
 * )
 * @ApiFilter(
 *  OrderFilter::class,
 *  properties={"familyName", "givenName",},
 *  arguments={"orderParameterName"="order"}
 * )
 */
class Person
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
     * @var string Family name. In the U.S., the last name of an Person. This can be used along with givenName instead of the name property.
     *
     * @ORM\Column(type="text")
     * @ApiProperty(iri="http://schema.org/familyName")
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @ApiFilter(SearchFilter::class, strategy="partial")
     */
    private $familyName;

    /**
     * @var string Given name. In the U.S., the first name of a Person. This can be used along with familyName instead of the name property.
     *
     * @ORM\Column(type="text")
     * @ApiProperty(iri="http://schema.org/givenName")
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     */
    private $givenName;

    /**
     * @var string the name of the item compose by the familyName and givenName
     *
     * @ApiProperty(iri="http://schema.org/name")
     */
    private $name;

    /**
     * @var string|null a description of the item
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/description")
     * @Assert\Type(type="string")
     */
    private $description;

    /**
     * @var string A sub property of description. A short description of the item used to disambiguate from other, similar items. Information from other properties (in particular, name) may be necessary for the description to be useful for disambiguation.
     *
     * @ORM\Column(type="text")
     * @ApiProperty(iri="http://schema.org/disambiguatingDescription")
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     */
    private $disambiguatingDescription;

    /**
     * @var string|null An image of the item. This can be a \[\[URL\]\] or a fully described \[\[ImageObject\]\].
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/image")
     * @Assert\Url
     */
    private $image;

    /**
     * @var string|null URL of the item
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/url")
     * @Assert\Url
     */
    private $url;

    /**
     * @var Collection<Organization>|null an Organization (or ProgramMembership) to which this Person or Organization belongs
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Organization", inversedBy="members")
     * @ApiProperty(iri="http://schema.org/memberOf")
     */
    private $memberOf;

    /**
     * @Gedmo\Slug(fields={"givenName", "familyName"})
     * @ORM\Column(length=300, unique=true)
     * @ApiProperty(identifier=true)
     */
    private $slug;

    /**
    * @var Collection<CreativeWork>|null the CreativeWorks that the person maintains
    * 
    * @ORM\ManyToMany(targetEntity="App\Entity\CreativeWork", mappedBy="maintainers")
    * @ApiProperty(iri="http://schema.org/CreativeWork")
    */
    private $maintainerOf;

    public function __construct()
    {
        $this->memberOf = new ArrayCollection();
        $this->maintainerOf = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setFamilyName(?string $familyName): void
    {
        $this->familyName = $familyName;
    }

    public function getFamilyName(): ?string
    {
        return $this->familyName;
    }

    public function setGivenName(?string $givenName): void
    {
        $this->givenName = $givenName;
    }

    public function getGivenName(): ?string
    {
        return $this->givenName;
    }

    public function getName(): ?string
    {
        return $this->givenName . ' ' . $this->familyName;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDisambiguatingDescription(?string $disambiguatingDescription): void
    {
        $this->disambiguatingDescription = $disambiguatingDescription;
    }

    public function getDisambiguatingDescription(): ?string
    {
        return $this->disambiguatingDescription;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function addMemberOf(Organization $memberOf): void
    {
        $this->memberOf[] = $memberOf;
    }

    public function removeMemberOf(Organization $memberOf): void
    {
        $this->memberOf->removeElement($memberOf);
    }

    public function getMemberOf(): Collection
    {
        return $this->memberOf;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return Collection|CreativeWork[]
     */
    public function getMaintainerOf(): Collection
    {
        return $this->maintainerOf;
    }

    public function addMaintainerOf(CreativeWork $maintainerOf): self
    {
        if (!$this->maintainerOf->contains($maintainerOf)) {
            $this->maintainerOf[] = $maintainerOf;
            $maintainerOf->addMaintainer($this);
        }

        return $this;
    }

    public function removeMaintainerOf(CreativeWork $maintainerOf): self
    {
        if ($this->maintainerOf->contains($maintainerOf)) {
            $this->maintainerOf->removeElement($maintainerOf);
            $maintainerOf->removeMaintainer($this);
        }

        return $this;
    }
}
