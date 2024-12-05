<?php

declare(strict_types=1);

namespace Advent\Day4;

//----- Initialization
use ArtemiiKarkusha\Aoc2024\FileInputGetter;
use ArtemiiKarkusha\Aoc2024\InputDataLinesExtractor;

use function dirname;
use function sprintf;

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/../vendor/autoload.php';

$startTime = hrtime(true);
$inputDataExtractor = new InputDataLinesExtractor(
    new FileInputGetter(dirname(__DIR__) . '/data/input-data.txt')
);

function stringToArray($s)
{
    $r = array();
    for ($i = 0, $iMax = strlen($s); $i < $iMax; $i++) {
        $r[$i] = $s[$i];
    }
    return $r;
}

/*
$coordinates = [
    'x' => '',
    'y' => ''
];
*/
function addCoordinatesToEchOfItem($item, $lineKey, $itemKey)
{
    return [
        'y' => $lineKey,
        'x' => $itemKey,
        'value' => $item
    ];
}

//----- Initialization


//----- Main functionality
$findsCounter = 0;
$foundWords = [];
$phrasesToFind = [
    ['X', 'M', 'A', 'S'],
    ['S', 'M', 'A', 'X']
];
$expration = '/(XMAS)|(SMAX)/i';
//Convert Input Data Into Matrix x*x
$matrix = [];

// Convert Input into matrix
foreach ($inputDataExtractor->getInputDataLines() as $lineKey => $inputDataLine) {
    $matrix[] = stringToArray($inputDataLine);
}

function nextSymbolforXMAS($symbol): string
{
    $nextSymbol = '';
    switch ($symbol) {
        case 'X':
            $nextSymbol = 'M';
            break;
        case 'M':
            $nextSymbol = 'A';
            break;
        case 'A':
            $nextSymbol = 'S';
            break;
    }
    return $nextSymbol;
}

function isWordFound(string $word): string
{
    return strlen($word) === 4;
}

// Find Phrase in matrix
//foreach (['X','M','A','S'] as $symbolToFind) {
/*$foundPhrase = [
    [
        'y' => $lineKey,
        'x' => $itemKey,
        'value' => $item
    ]
];*/
/**
 * @param string $symbolToFind
 * @param int $yCurrentCoordinateS
 * @param int|string $xCurrentCoordinateS
 * @param array $matrix
 * @param WordTreeNode $wordTree
 * @return void
 */
function buildTreeForWord(
    string $symbolToFind,
    int $yCurrentCoordinateS,
    int|string $xCurrentCoordinateS,
    array $matrix,
    WordTreeNode $wordTree
): void {
    $symbolToFind = nextSymbolforXMAS($symbolToFind);
    $foundSymbols = findAllNextSymbolsForCurrentSymbol(
        $symbolToFind,
        $yCurrentCoordinateS,
        $xCurrentCoordinateS,
        $matrix,
    );

    $symbolsWithValidPosition = $foundSymbols;
    if ($parentNode = $wordTree?->getParent()) {
        $parentY = $parentNode->getY();
        $parentX = $parentNode->getX();
        $currentY = $wordTree->getY();
        $currentX = $wordTree->getX();

        if ($currentY >= $parentY) {
            $possibleYPositionIs = $currentY + ($currentY - $parentY);
        } else {
            $possibleYPositionIs = $currentY - ($parentY - $currentY);
        }

        if ($currentX >= $parentX) {
            $possibleXPositionIs = $currentX + ($currentX - $parentX);
        } else {
            $possibleXPositionIs = $currentX - ($parentX - $currentX);
        }


        $symbolsWithValidPosition = [];
        foreach ($foundSymbols as $foundSymbol) {
            if ($foundSymbol['y'] !== $possibleYPositionIs) {
                continue;
            }
            if ($foundSymbol['x'] !== $possibleXPositionIs) {
                continue;
            }

            $symbolsWithValidPosition[] = $foundSymbol;
        }
    }


    foreach ($symbolsWithValidPosition as $coordinates) {
        $wordTreeNode = new WordTreeNode($symbolToFind, $coordinates['y'], $coordinates['x'], $wordTree);
        $wordTree->addChild($wordTreeNode);
        buildTreeForWord(
            $wordTreeNode->getSymbol(),
            $wordTreeNode->getY(),
            $wordTreeNode->getX(),
            $matrix,
            $wordTreeNode
        );
    }
}

function findAllNextSymbolsForCurrentSymbol(string $symbolToFind, $yCoordinate, $xCoordinate, $matrix): array
{
    $matrixWithExcludedSymbol = $matrix;
    $foundSymbolsCoordinates = [];
    do {
        $nextSymbolCoordinates = findNextSymbolCoordinates(
            $symbolToFind,
            $yCoordinate,
            $xCoordinate,
            $matrixWithExcludedSymbol
        );


        if ($nextSymbolCoordinates) {
            $foundSymbolsCoordinates[] = [
                'y' => $nextSymbolCoordinates['y'],
                'x' => $nextSymbolCoordinates['x'],
            ];

            $matrixWithExcludedSymbol = getMatrixWithExcludedSymbol(
                $matrixWithExcludedSymbol,
                $nextSymbolCoordinates['y'],
                $nextSymbolCoordinates['x']
            );
        }
    } while (!empty($nextSymbolCoordinates));

    return $foundSymbolsCoordinates;
}

/**
 * @param $symbolToFind
 * @param $y
 * @param $x
 * @param $matrix
 * @return int[]
 */
function findNextSymbolCoordinates($symbolToFind, $y, $x, $matrix): array
{
    foreach ($matrix as $lineKey => $symbols) {
        if (
            $lineKey < $y - 1 || $lineKey > $y + 1
        ) {
            continue;
        }

        foreach ($symbols as $symbolKey => $symbol) {
            if (
                $symbolKey < $x - 1 || $symbolKey > $x + 1
            ) {
                continue;
            }

            if ($symbol !== $symbolToFind) {
                continue;
            }

            return [
                'y' => $lineKey,
                'x' => $symbolKey,
            ];
        }
    }

    return [];
}

function getMatrixWithExcludedSymbol($matrix, $yCoordinate, $xCoordinate): array
{
    $matrix[$yCoordinate][$xCoordinate] = '.';
    return $matrix;
}

function debugTree(WordTreeNode $wordTreeNode, $iteration = 0): void
{
    $children = $wordTreeNode->getChildren();
    echo '---------------------' . PHP_EOL;
    echo 'SYMBOL: ' . $wordTreeNode->getSymbol() . PHP_EOL;
    echo 'Y: ' . $wordTreeNode->getY()+1 . PHP_EOL;
    echo 'X: ' . $wordTreeNode->getX()+1 . PHP_EOL;
    echo 'Iteration: ' . $iteration . PHP_EOL;
    foreach ($children as $child) {
        debugTree($child, $iteration++);
    }
}

function calculateCountOfFoundWords(WordTreeNode $wordTreeNode, int $expectedCountOfSymbols, int $iteration = 1): int
{
    $iteration++;
    $count = 0;
    foreach ($wordTreeNode->getChildren() as $child) {
        $count += calculateCountOfFoundWords($child, $expectedCountOfSymbols, $iteration);
    }

    if ($children = $wordTreeNode->getChildren()) {
        foreach ($children as $child) {
            if(empty($child->getChildren()) && $iteration === $expectedCountOfSymbols) {
                return count($wordTreeNode->getChildren());
            }
        }
    }

    return $count;




}
///private/tmp/pear/temp/pear-build-root94iO0a/install-xdebug-3.4.0/usr/local/Cellar/php@8.3/8.3.14/pecl/20230831/

//----- Main functionality
$countFounds = 0;
$expectedCountOfSymbols = 4;
$libraryWords = [];
foreach ($matrix as $lineKey => $symbols) {
    foreach ($symbols as $symbolKey => $symbol) {
        if ($symbol !== 'X') {
            continue;
        }
        $symbolToFind = $symbol;
        $yCurrentCoordinateS = $lineKey;
        $xCurrentCoordinateS = $symbolKey;
        $wordTree = new WordTreeNode('X', $yCurrentCoordinateS, $xCurrentCoordinateS);
        $libraryWords[] = $wordTree;

        buildTreeForWord($symbolToFind, $yCurrentCoordinateS, $xCurrentCoordinateS, $matrix, $wordTree);

        $countFounds += calculateCountOfFoundWords($wordTree, $expectedCountOfSymbols, 1);
    }
}
//----- Main functionality



// Output
echo sprintf(
    'Results of the finds: %s. %s',
    $countFounds,
    PHP_EOL
);

$endTime = hrtime(true);
echo sprintf('Time execution: %s ms %s', ($endTime - $startTime) / 1e6, PHP_EOL);
echo sprintf('Memory Usage: %s', round(memory_get_usage() / 1024)), 'KB' . PHP_EOL;
//----- Output
