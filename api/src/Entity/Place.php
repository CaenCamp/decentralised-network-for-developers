<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
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
 *  normalizationContext={"groups"={"organization"}},
 *  denormalizationContext={"groups"={"organization"}},
 *  itemOperations={
 *     "get": {
 *         "method": "GET",
 *         "controller": SomeRandomController::class
 *     }
 * })
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
     * @var PostalAddress|null physical address of the item
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\PostalAddress", cascade={"persist"})
     * @ApiProperty(iri="http://schema.org/address")
     * @Groups({"organization", "post"})
     */
    private $address;

    /**
     * @var string|null a URL to a map of the place
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/hasMap")
     * @Assert\Url
     * @Groups({"organization"})
     */
    private $hasMap;

    /**
     * @var float|null
     *
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type="float")
     * @Groups({"organization"})
     */
    private $latitude;

    /**
     * @var float|null
     *
     * @ORM\Column(type="float", nullable=true)
     * @Assert\Type(type="float")
     * @Groups({"organization"})
     */
    private $longitude;

    /**
     * @var int|null the total number of individuals that may attend an event or venue
     *
     * @ORM\Column(type="integer", nullable=true)
     * @ApiProperty(iri="http://schema.org/maximumAttendeeCapacity")
     * @Assert\Type(type="integer")
     * @Groups({"organization"})
     */
    private $maximumAttendeeCapacity;

    public function getId(): ?string
    {
        return $this->id;
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
