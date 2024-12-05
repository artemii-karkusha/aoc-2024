<?php

declare(strict_types=1);

namespace Advent\Day4;

class WordTreeNode
{
    /**
     * @var WordTreeNode[]
     */
    private $children = [];

    /**
     * @param string $symbol
     * @param int $yCoordinate
     * @param int $xCoordinate
     * @param WordTreeNode|null $parentNode
     */
    public function __construct(
        private string $symbol,
        private int $yCoordinate,
        private int $xCoordinate,
        private ?WordTreeNode $parentNode = null
    ) {
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->yCoordinate;
    }

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->xCoordinate;
    }

    /**
     * @return string
     */
    public function getSymbol(): string
    {
        return $this->symbol;
    }

    /**
     * @param WordTreeNode $wordTreeNode
     * @return void
     */
    public function addChild(WordTreeNode $wordTreeNode): void
    {
        $this->children[] = $wordTreeNode;
    }

    /**
     * @return WordTreeNode[]
     */
    public function getChildren(): array
    {
        return $this->children;
    }

    public function getParent(): ?WordTreeNode
    {
        return $this->parentNode;
    }
}
