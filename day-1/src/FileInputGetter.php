<?php

declare(strict_types=1);

namespace Advent\Day1;

use JetBrains\PhpStorm\Pure;
use Symfony\Component\Filesystem\Filesystem;

class FileInputGetter implements InputGetterInterface
{
    /**
     * @var Filesystem $filesystem
     */
    private Filesystem $filesystem;

    public function __construct()
    {
        $this->filesystem = new Filesystem();
    }

    /**
     * @return string
     */
    public function getInputData(): string
    {
        return $this->filesystem->readFile(dirname(__DIR__).'/data/historiansInput.txt');
    }
}