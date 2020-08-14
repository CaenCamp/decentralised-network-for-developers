<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An organization such as a school, NGO, corporation, club, etc.
 *
 * @see http://schema.org/Organization Documentation on Schema.org
 *
 * @ORM\Entity
 * @ApiResource(
 *  iri="http://schema.org/Organization",
 *  normalizationContext={"groups"={"organization"}},
 *  denormalizationContext={"groups"={"organization"}},
 *  attributes={"order"={"name": "ASC"}}
 * )
 * @ApiFilter(
 *  OrderFilter::class,
 *  properties={"name", "location.address.postalCode"},
 *  arguments={"orderParameterName"="order"}
 * )
 */
class Organization
{
    /**
     * @var string|null
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid")
     * @ApiProperty(identifier=false)
     * @Assert\Uuid
     */
    private $id;

    /**
     * @var string the name of the item
     *
     * @ORM\Column(type="text")
     * @ApiProperty(iri="http://schema.org/name")
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Groups({"organization"})
     * @ApiFilter(SearchFilter::class, strategy="partial")
     */
    private $name;

    /**
     * @var string|null a description of the item
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/description")
     * @Assert\Type(type="string")
     * @Groups({"organization"})
     */
    private $description;

    /**
     * @var string|null A sub property of description. A short description of the item used to disambiguate from other, similar items. Information from other properties (in particular, name) may be necessary for the description to be useful for disambiguation.
     *
     * @ORM\Column(type="text")
     * @ApiProperty(iri="http://schema.org/disambiguatingDescription")
     * @Assert\Type(type="string")
     * @Assert\NotBlank
     * @Groups({"organization"})
     */
    private $disambiguatingDescription;

    /**
     * @var string|null An image of the item. This is a \[\[URL\]\].
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/image")
     * @Assert\Url
     * @Groups({"organization"})
     */
    private $image;

    /**
     * @var string|null URL of the item
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/url")
     * @Assert\Url
     * @Groups({"organization"})
     */
    private $url;

    /**
     * @var Place|null the location of for example where the event is happening, an organization is located, or where an action takes place
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Place", cascade={"persist"})
     * @ApiProperty(iri="http://schema.org/location")
     * @Groups({"organization", "post"})
     * @ApiFilter(SearchFilter::class, properties={"location.address.postalCode": "start"})
     * @ApiFilter(SearchFilter::class, properties={"location.address.addressLocality": "start"})
     * @ApiFilter(ExistsFilter::class, properties={"location.hasMap"})
     */
    private $location;

    /**
     * @var string|null email address
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/email")
     * @Assert\Email
     * @Groups({"organization"})
     */
    private $email;

    /**
     * @var Collection<Person>|null a member of this organization
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\Person", mappedBy="memberOf")
     * @ApiProperty(iri="http://schema.org/members")
     * @Groups({"organization"})
     */
    private $members;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=250, unique=true)
     * @ApiProperty(identifier=true)
     */
    private $slug;

    public function __construct()
    {
        $this->employees = new ArrayCollection();
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

    public function setLocation(?Place $location): void
    {
        $this->location = $location;
    }

    public function getLocation(): ?Place
    {
        return $this->location;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function addMember(Person $member): void
    {
        $this->members[] = $member;
    }

    public function removeMember(Person $member): void
    {
        $this->members->removeElement($member);
    }

    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function getSlug()
    {
        return $this->slug;
    }
}
