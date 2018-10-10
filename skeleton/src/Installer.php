<?php declare(strict_types=1);

namespace Skeleton;

class Installer
{
    public function removeInstaller(string $directory): void
    {
        unlink($directory);
    }
}
