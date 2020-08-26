<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Enum\EventAttendanceModeType;
use App\Enum\EventStatusType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * An event happening at a certain time and location, such as a concert, lecture, or festival. Ticketing information may be added via the \[\[offers\]\] property. Repeated events may be structured as separate Event objects.
 *
 * @see http://schema.org/Event Documentation on Schema.org
 *
 * @ORM\Entity
 * @ApiResource(iri="http://schema.org/Event")
 */
class Event
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
     */
    private $name;

    /**
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=300, unique=true)
     * @ApiProperty(identifier=true)
     */
    private $slug;

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
     * @var string|null an eventStatus of an event represents its status; particularly useful when an event is cancelled or rescheduled
     *
     * @ORM\Column(nullable=true)
     * @ApiProperty(iri="http://schema.org/eventStatus")
     * @Assert\Type(type="string")
     * @Assert\Choice(callback={"EventStatusType", "toArray"})
     */
    private $eventStatus;

    /**
     * @var string|null The eventAttendanceMode of an event indicates whether it occurs online, offline, or a mix.
     *
     * @ORM\Column(nullable=true)
     * @ApiProperty(iri="http://schema.org/eventAttendanceMode")
     * @Assert\Type(type="string")
     * @Assert\Choice(callback={"EventAttendanceModeType", "toArray"})
     */
    private $eventAttendanceMode;

    /**
     * @var string|null The language of the content or performance or used in an action. Please use one of the language codes from the \[IETF BCP 47 standard\](http://tools.ietf.org/html/bcp47). See also \[\[availableLanguage\]\].
     *
     * @ORM\Column(type="text", nullable=true)
     * @ApiProperty(iri="http://schema.org/inLanguage")
     * @Assert\Type(type="string")
     */
    private $inLanguage;

    /**
     * @var bool|null a flag to signal that the item, event, or place is accessible for free
     *
     * @ORM\Column(type="boolean", nullable=true)
     * @ApiProperty(iri="http://schema.org/isAccessibleForFree")
     */
    private $isAccessibleForFree;

    /**
     * @var \DateTimeInterface|null the time admission will commence
     *
     * @ORM\Column(type="datetime", nullable=true)
     * @ApiProperty(iri="http://schema.org/doorTime")
     * @Assert\DateTime
     */
    private $doorTime;

    /**
     * @var \DateTimeInterface|null The start date and time of the item (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601)).
     *
     * @ORM\Column(type="datetime", nullable=true)
     * @ApiProperty(iri="http://schema.org/startDate")
     * @Assert\DateTime
     */
    private $startDate;

    /**
     * @var \DateTimeInterface|null The end date and time of the item (in \[ISO 8601 date format\](http://en.wikipedia.org/wiki/ISO\_8601)).
     *
     * @ORM\Column(type="datetime", nullable=true)
     * @ApiProperty(iri="http://schema.org/endDate")
     * @Assert\DateTime
     */
    private $endDate;

    /**
     * @var Place|null the location of for example where the event is happening, an organization is located, or where an action takes place
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Place")
     * @ApiProperty(iri="http://schema.org/location")
     */
    private $location;

    /**
     * @var Organization|null an organizer of an Event
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Organization")
     * @ApiProperty(iri="http://schema.org/organizer")
     */
    private $organizer;

    /**
     * @var Organization|null A person or organization that supports a thing through a pledge, promise, or financial contribution. e.g. a sponsor of a Medical Study or a corporate sponsor of an event.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Organization")
     * @ApiProperty(iri="http://schema.org/sponsor")
     */
    private $sponsor;

    /**
     * @var Collection<VideoObject>|null the Videos that captured all or part of this Event
     *
     * @ORM\OneToMany(
     *      targetEntity="App\Entity\VideoObject",
     *      mappedBy="recordedAt",
     *      cascade={"persist"},
     *      orphanRemoval=false
     * )
     * @ApiProperty(iri="http://schema.org/recordedIn")
     */
    private $recordedIn;

    /**
     * @var Collection<CreativeWork>|null A work performed in some event, for example a play performed in a TheaterEvent.
     *
     * @ORM\ManyToMany(
     *      targetEntity="App\Entity\CreativeWork",
     *      inversedBy="performedInEvents",
     *      cascade={"persist", "remove"},
     *      orphanRemoval=true
     * )
     * @ApiProperty(iri="http://schema.org/workPerformed")
     */
    private $worksPerformed;

    public function __construct()
    {
        $this->worksPerformed = new ArrayCollection();
        $this->recordedIn = new ArrayCollection();
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

    public function getSlug()
    {
        return $this->slug;
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

    public function setEventStatus(?string $eventStatus): void
    {
        $this->eventStatus = $eventStatus;
    }

    public function getEventStatus(): ?string
    {
        return $this->eventStatus;
    }

    public function setEventAttendanceMode(?string $eventAttendanceMode): void
    {
        $this->eventAttendanceMode = $eventAttendanceMode;
    }

    public function getEventAttendanceMode(): ?string
    {
        return $this->eventAttendanceMode;
    }

    public function setInLanguage(?string $inLanguage): void
    {
        $this->inLanguage = $inLanguage;
    }

    public function getInLanguage(): ?string
    {
        return $this->inLanguage;
    }

    public function setIsAccessibleForFree(?bool $isAccessibleForFree): void
    {
        $this->isAccessibleForFree = $isAccessibleForFree;
    }

    public function getIsAccessibleForFree(): ?bool
    {
        return $this->isAccessibleForFree;
    }

    public function setDoorTime(?\DateTimeInterface $doorTime): void
    {
        $this->doorTime = $doorTime;
    }

    public function getDoorTime(): ?\DateTimeInterface
    {
        return $this->doorTime;
    }

    public function setStartDate(?\DateTimeInterface $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setLocation(?Place $location): void
    {
        $this->location = $location;
    }

    public function getLocation(): ?Place
    {
        return $this->location;
    }

    public function setOrganizer(?Organization $organizer): void
    {
        $this->organizer = $organizer;
    }

    public function getOrganizer(): ?Organization
    {
        return $this->organizer;
    }

    public function setSponsor(?Organization $sponsor): void
    {
        $this->sponsor = $sponsor;
    }

    public function getSponsor(): ?Organization
    {
        return $this->sponsor;
    }

    /**
     * @return Collection|CreativeWork[]
     */
    public function getWorksPerformed(): Collection
    {
        return $this->workPerformed;
    }

    public function addWorksPerformed(CreativeWork $creativeWork): self
    {
        if (!$this->worksPerformed->contains($creativeWork)) {
            $this->worksPerformed[] = $creativeWork;
        }

        return $this;
    }

    public function removeWorksPerformed(CreativeWork $creativeWork): self
    {
        if ($this->worksPerformed->contains($creativeWork)) {
            $this->worksPerformed->removeElement($creativeWork);
        }

        return $this;
    }

    /**
     * @return Collection|VideoObject[]
     */
    public function getRecordedIn(): Collection
    {
        return $this->recordedIn;
    }

    public function addRecordedIn(VideoObject $video): self
    {
        if (!$this->recordedIn->contains($video)) {
            $this->recordedIn[] = $video;
        }

        return $this;
    }

    public function removeRecordedIn(VideoObject $video): self
    {
        if ($this->recordedIn->contains($video)) {
            $this->recordedIn->removeElement($video);
        }

        return $this;
    }

}
