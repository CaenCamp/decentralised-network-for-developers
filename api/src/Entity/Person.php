<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * A person (alive, dead, undead, or fictional).
 *
 * @see http://schema.org/Person Documentation on Schema.org
 *
 * @ORM\Entity
 * @ApiResource(iri="http://schema.org/Person")
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
     */
    private $id;

    /**
     * @var string|null an additional name for a Person, can be used for a middle name
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/additionalName")
     * @Assert\Type(type="string")
     */
    private $additionalName;

    /**
     * @var string|null Family name. In the U.S., the last name of an Person. This can be used along with givenName instead of the name property.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/familyName")
     * @Assert\Type(type="string")
     */
    private $familyName;

    /**
     * @var string|null Given name. In the U.S., the first name of a Person. This can be used along with familyName instead of the name property.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/givenName")
     * @Assert\Type(type="string")
     */
    private $givenName;

    /**
     * @var string|null an honorific prefix preceding a Person's name such as Dr/Mrs/Mr
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/honorificPrefix")
     * @Assert\Type(type="string")
     */
    private $honorificPrefix;

    /**
     * @var string|null a description of the item
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/description")
     * @Assert\Type(type="string")
     */
    private $description;

    /**
     * @var string|null A sub property of description. A short description of the item used to disambiguate from other, similar items. Information from other properties (in particular, name) may be necessary for the description to be useful for disambiguation.
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/disambiguatingDescription")
     * @Assert\Type(type="string")
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
     * @var Organization|null an Organization (or ProgramMembership) to which this Person or Organization belongs
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Organization")
     * @ApiProperty(iri="http://schema.org/memberOf")
     */
    private $memberOf;

    /**
     * @var Event|null event that this person is a performer or participant in
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Event")
     * @ApiProperty(iri="http://schema.org/performerIn")
     */
    private $performerIn;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setAdditionalName(?string $additionalName): void
    {
        $this->additionalName = $additionalName;
    }

    public function getAdditionalName(): ?string
    {
        return $this->additionalName;
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

    public function setHonorificPrefix(?string $honorificPrefix): void
    {
        $this->honorificPrefix = $honorificPrefix;
    }

    public function getHonorificPrefix(): ?string
    {
        return $this->honorificPrefix;
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

    public function setMemberOf(?Organization $memberOf): void
    {
        $this->memberOf = $memberOf;
    }

    public function getMemberOf(): ?Organization
    {
        return $this->memberOf;
    }

    public function setPerformerIn(?Event $performerIn): void
    {
        $this->performerIn = $performerIn;
    }

    public function getPerformerIn(): ?Event
    {
        return $this->performerIn;
    }
}
