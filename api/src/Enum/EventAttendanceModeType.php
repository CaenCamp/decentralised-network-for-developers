<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * The eventAttendanceMode of an event indicates whether it occurs online, offline, or a mix.
 *
 * @see https://schema.org/eventAttendanceMode Documentation on Schema.org
 * @ApiResource(iri="http://schema.org/eventAttendanceMode")
 */
class EventAttendanceModeType  extends Enum
{
    /**
     * @var string MixedEventAttendanceMode - an event that is conducted as a combination of both offline and online modes.
     */
    public const EVENT_MODE_MIXED = 'http://schema.org/MixedEventAttendanceMode';

    /**
     * @var string OfflineEventAttendanceMode - an event that is primarily conducted offline.
     */
    public const EVENT_MODE_OFFLINE = 'http://schema.org/OfflineEventAttendanceMode';

    /**
     * @var string OnlineEventAttendanceMode - an event that is primarily conducted online.
     */
    public const EVENT_MODE_ONLINE = 'http://schema.org/OnlineEventAttendanceMode';

}
