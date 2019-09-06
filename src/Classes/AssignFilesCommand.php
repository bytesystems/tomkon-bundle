<?php declare(strict_types = 1);

namespace bytesystems\TomkonBundle\Classes\Command;

use Contao\CoreBundle\Command\AbstractLockedCommand;
use Contao\CoreBundle\Framework\FrameworkAwareTrait;
use Esit\Xmlcatchregion\Classes\Events\Import\OnImportEvent;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class AssignFilesCommand extends AbstractLockedCommand
{
    use FrameworkAwareTrait;

    private $io;
    private $rows = [];
    private $statusCode = 0;
    protected function configure(): void
    {
        $commandHelp    = 'Aktualisiert Dateien';
        $this->setName('tomkon:assignfiles')
            ->setDescription($commandHelp);
    }
    protected function executeLocked(InputInterface $input, OutputInterface $output): ?int
    {
        // Framework initialisieren
        $this->framework->initialize();

        $this->io = new SymfonyStyle($input, $output);
        /* Wird hier nicht benötigt, ist aber ganz nützlich.
        // Der Container steht im Konstruktor noch nicht zur Verfügung und kann somit nicht injiziert werden!
        $this->di = $this->getContainer()->get('event_dispatcher');
        // TL_ROOT kann nicht injiziert werden und steht im Command nicht zur Verfügung!
        // Deshalb wird hier das root directory ausgelesen.
        $rootDir = $this->getContainer()->getParameter('kernel.project_dir');
        */
        // Hier wird die eigentliche Verarbeitung auf gerufen.
        $this->assignFiles();
        if (!empty($this->rows)) {
            $this->io->newLine();
            $this->io->table(['', 'Ouput', 'Target / Error'], $this->rows);
        }
        return $this->statusCode;
    }
    protected function assignFiles(): void
    {
        // Hier findet die eigentliche Verarbeitung statt.
        // Normalerweise würde hier z.B. ein Event aufgerufen.
        $this->io->text("Hallo Welt!");
    }
}
