<?php

declare(strict_types=1);

namespace Advent\Day1;

use ArtemiiKarkusha\Aoc2024\InputDataLinesExtractor;

class LocationsIdsExtractor
{
    public const DELIMETER_FOR_GROUPS = '   ';

    public function __construct(
        private readonly InputDataLinesExtractor $dataLinesExtractor,
    ) {
    }

    public function extractLocations(): array
    {
        $historiansFindsOfLines = $this->dataLinesExtractor->getInputDataLines();
        $locationsIdsGroups1 = [];
        $locationsIdsGroups2 = [];

        // Extract locationsIds from finds line
        foreach ($historiansFindsOfLines as $historiansFindsOfGroups) {
            list($locationId1, $locationId2) = explode(self::DELIMETER_FOR_GROUPS, $historiansFindsOfGroups);
            $locationsIdsGroups1[] = (int)$locationId1;
            $locationsIdsGroups2[] = (int)$locationId2;
        }

        return [$locationsIdsGroups1, $locationsIdsGroups2];
    }
}