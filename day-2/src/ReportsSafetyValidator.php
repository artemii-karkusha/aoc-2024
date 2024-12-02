<?php

declare(strict_types=1);

namespace Advent\Day2;

class ReportsSafetyValidator
{
    /**
     * @param ItemsSafetyIdentifier $itemsSafetyIdentifier
     */
    public function __construct(
        private readonly ItemsSafetyIdentifier $itemsSafetyIdentifier
    ) {
    }

    /**
     * @param $reportLevels
     * @return bool
     */
    public function isReportSafe($reportLevels): bool
    {
        return $this->itemsSafetyIdentifier->areItemsSafe($reportLevels);
    }

    /**
     * @param array $reportLevels
     * @return bool
     */
    public function isReportSafeWithoutOneUnsafeLevel(array $reportLevels): bool
    {
        $lastUnsafeItemKeys = $this->itemsSafetyIdentifier->getLastUnsafeItemKeys();

        foreach ($lastUnsafeItemKeys as $lastUnsafeItemKey) {
            $reportWithoutUnsafeLevel = $this->getReportWithoutUnsafeLevel($reportLevels, $lastUnsafeItemKey);

            if ($this->itemsSafetyIdentifier->areItemsSafe($reportWithoutUnsafeLevel)) {
                return true;
            }
        }

        return false;
    }


    /**
     * @param array $reportLevels
     * @param int $levelToRemove
     * @return array
     */
    private function getReportWithoutUnsafeLevel(array $reportLevels, int $levelToRemove): array
    {
        return array_values(
            array_filter($reportLevels, function ($item, $key) use ($levelToRemove) {
                return (int)$key !== (int)$levelToRemove;
            }, ARRAY_FILTER_USE_BOTH)
        );
    }


}