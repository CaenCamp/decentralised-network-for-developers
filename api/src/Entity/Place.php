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
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Entities that have a somewhat fixed, physical extension.
 *
 * @see http://schema.org/Place Documentation on Schema.org
 *
 * @ORM\Entity
 * @ApiResource(
 *  iri="http://schema.org/Place",
 *  normalizationContext={"groups"={"place"}},
 *  denormalizationContext={"groups"={"place"}},
 * )
 * @ApiFilter(ExistsFilter::class, properties={"name"})
 */
class Place
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
     * @var string the name of the Place
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/name")
     * @Assert\Type(type="string")
     * @Groups({"place"})
     * @ApiFilter(SearchFilter::class, strategy="partial")
     */
    private $name;

    /**
     * @var string|null a description of the place
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/description")
     * @Assert\Type(type="string")
     * @Groups({"place"})
     */
    private $description;

    /**
     * @var string|null A sub property of description. A short description of the item used to disambiguate from other, similar items. Information from other properties (in particular, name) may be necessary for the description to be useful for disambiguation.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/disambiguatingDescription")
     * @Assert\Type(type="string")
     * @Groups({"place"})
     */
    private $disambiguatingDescription;

    /**
     * @var string|null An associated logo.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/image")
     * @Assert\Url
     * @Groups({"place"})
     */
    private $logo;

    /**
     * @var string|null URL of the item
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/url")
     * @Assert\Url
     * @Groups({"place"})
     */
    private $url;

    /**
     * @var PostalAddress|null physical address of the item
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\PostalAddress", cascade={"persist"})
     * @ApiProperty(iri="http://schema.org/address")
     * @Groups({"organization", "place"})
     * @ApiFilter(SearchFilter::class, properties={"address.postalCode": "start"})
     * @ApiFilter(SearchFilter::class, properties={"address.addressLocality": "start"})
     */
    private $address;

    /**
     * @var string|null a URL to a map of the place
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/hasMap")
     * @Assert\Url
     * @Groups({"organization", "place"})
     */
    private $hasMap;

    /**
     * @var float|null
     *
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type="float")
     * @Groups({"organization", "place"})
     */
    private $latitude;

    /**
     * @var float|null
     *
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type="float")
     * @Groups({"organization", "place"})
     */
    private $longitude;

    /**
     * @var int|null the total number of individuals that may attend an event or venue
     *
     * @ORM\Column(type="integer", nullable=true)
     * @ApiProperty(iri="http://schema.org/maximumAttendeeCapacity")
     * @Assert\Type(type="integer")
     * @Groups({"place"})
     */
    private $maximumAttendeeCapacity;

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

    public function setLogo(?string $logo): void
    {
        $this->logo = $logo;
    }

    public function getLogo(): ?string
    {
        return $this->logo;
    }

    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setAddress(?PostalAddress $address): void
    {
        $this->address = $address;
    }

    public function getAddress(): ?PostalAddress
    {
        return $this->address;
    }

    public function setHasMap(?string $hasMap): void
    {
        $this->hasMap = $hasMap;
    }

    public function getHasMap(): ?string
    {
        return $this->hasMap;
    }

    /**
     * @param float|null $latitude
     */
    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return float|null
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float|null $longitude
     */
    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return float|null
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setMaximumAttendeeCapacity(?int $maximumAttendeeCapacity): void
    {
        $this->maximumAttendeeCapacity = $maximumAttendeeCapacity;
    }

    public function getMaximumAttendeeCapacity(): ?int
    {
        return $this->maximumAttendeeCapacity;
    }
}
