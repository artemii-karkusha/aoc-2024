<?php

declare(strict_types=1);

namespace Advent\Day1;

use Advent\Day1\InputGetterInterface;

class LocationsIdsExtractor
{
    public const DELIMETER_FOR_GROUPS = '   ';
    public const DELIMETER_FOR_LOCATIONS = "\n";

    public function __construct(private readonly InputGetterInterface $inputGetter)
    {
    }

    public function extractLocations(): array
    {
        $historiansFindsOfLines = $this->getConvertedLinesToContainLocations();
        $locationsIdsGroups1 = [];
        $locationsIdsGroups2 = [];

        // Extract locationsIds from finds line
        foreach ($historiansFindsOfLines as $historiansFindsOfGroups) {
            list($locationId1, $locationId2) = explode(LocationsIdsExtractor::DELIMETER_FOR_GROUPS, $historiansFindsOfGroups);
            $locationsIdsGroups1[] = (int)$locationId1;
            $locationsIdsGroups2[] = (int)$locationId2;
        }

        return [$locationsIdsGroups1, $locationsIdsGroups2];
    }

    /**
     * returns [
     *  "locationId     locationId",
     *  "locationId     locationId",
     *   ...
     * ]
     *
     * @return array
     */
    private function getConvertedLinesToContainLocations(): array
    {
        return explode(LocationsIdsExtractor::DELIMETER_FOR_LOCATIONS, $this->inputGetter->getInputData());
    }

}