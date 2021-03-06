<?php

/**
 * This file is part of Bic Engine package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Bic\Foundation\Console\Command;

use Bic\Boot\ExtensionInterface;
use Bic\Boot\RepositoryInterface;
use SebastianBergmann\Environment\Console;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

final class ExtListCommand extends Command
{
    /**
     * @param RepositoryInterface $repository
     */
    public function __construct(
        private readonly RepositoryInterface $repository,
    ) {
        parent::__construct('ext:list');
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setDescription('Displays a list of registered extensions');
    }

    /**
     * @return int
     */
    private function getConsoleMaxSize(): int
    {
        if (\class_exists(Console::class)) {
            return (new Console())->getNumberOfColumns();
        }

        return 80;
    }

    /**
     * @return int
     */
    private function getNameVersionMaxLength(): int
    {
        $length = 0;

        foreach ($this->repository->getExtensions() as $extension) {
            $actual = \mb_strlen($extension->getName()) + \mb_strlen($extension->getVersion()) + 4;
            $length = \max($length, $actual);
        }

        return $length;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $descriptionAvailableSize = $this->getConsoleMaxSize()
            - $this->getNameVersionMaxLength()
            - 2;

        $rows = [];
        foreach ($this->repository->getExtensions() as $ext) {
            $rows[] = [
                $this->getExtName($ext),
                $ext->getVersion(),
                $this->getExtDescription($ext, $descriptionAvailableSize),
            ];
        }

        (new SymfonyStyle($input, $output))
            ->table(['Name', 'Version', 'Description'], $rows)
        ;

        return self::SUCCESS;
    }

    /**
     * @param ExtensionInterface $ext
     * @param int $size
     * @return string
     */
    private function getExtDescription(ExtensionInterface $ext, int $size): string
    {
        $description = $ext->getDescription();

        if ($description !== '' && !\str_ends_with($description, '.')) {
            $description .= '.';
        }

        if ($size > 10) {
            return \wordwrap($description, $size);
        }

        return $description;
    }

    /**
     * @param ExtensionInterface $ext
     * @return string
     */
    private function getExtName(ExtensionInterface $ext): string
    {
        return \sprintf('%s', $ext->getName());
    }
}
