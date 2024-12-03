<?php

declare(strict_types=1);

namespace ArtemiiKarkusha\Aoc2024;

use Symfony\Component\Filesystem\Filesystem;

class FileInputGetter implements InputGetterInterface
{
    /**
     * @var Filesystem $filesystem
     */
    private Filesystem $filesystem;

    /**
     * @param string $filePath
     */
    public function __construct(private readonly string $filePath)
    {
        $this->filesystem = new Filesystem();
    }

    /**
     * @return string
     */
    public function getInputData(): string
    {
        return $this->filesystem->readFile($this->filePath);
    }
}
