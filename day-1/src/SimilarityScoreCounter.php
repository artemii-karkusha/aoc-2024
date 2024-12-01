<?php

declare(strict_types=1);

namespace Advent\Day1;
class SimilarityScoreCounter
{
    /**
     * @var array
     */
    private $countRepeatsForValues = [];

    /**
     * @param array $locationsIdsGroupd1
     * @param array $locationsIdsGroupd2
     * @return int
     */
    public function calculateSimilarityScore(array $locationsIdsGroupd1, array $locationsIdsGroupd2): int
    {
        $this->calculateCountRepeatsForValues($locationsIdsGroupd2);

        $similarityScore = 0;
        foreach ($locationsIdsGroupd1 as $locationId1) {
            echo '$locationId1' . PHP_EOL;
            var_dump($locationId1);
            echo '$this->getCountOfRepeats($locationId1)' . PHP_EOL;
            var_dump($this->getCountOfRepeats($locationId1));
            echo '($locationId1 * $this->getCountOfRepeats($locationId1))' . PHP_EOL;
            var_dump($locationId1 * $this->getCountOfRepeats($locationId1));
            $similarityScore += ($locationId1 * $this->getCountOfRepeats($locationId1));

            echo '$similarityScore' . PHP_EOL;
            var_dump($similarityScore);

            if ($similarityScore > 1000) {
                break;
            }
        }

        return $similarityScore;
    }

    private function calculateCountRepeatsForValues(array $locationsIdsGroupd2): void
    {
        foreach ($locationsIdsGroupd2 as $locationId) {
            if (!array_key_exists($locationId, $this->countRepeatsForValues)) {
                $this->countRepeatsForValues[$locationId] = 1;
                continue;
            }

            $this->countRepeatsForValues[$locationId]++;
        }
    }

    private function getCountOfRepeats(int $value): int
    {
        return $this->countRepeatsForValues[$value] ?? 0;
    }
}