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
        $commandHelp    = 'Erzeugt eine Testausgabe';
        $parameterHelp  = 'Name, der in der Testausgabe verwendet werden soll';
        $argument       = new InputArgument('name', InputArgument::REQUIRED, $parameterHelp);
        // Hier könnten weitere Parameter folgen.
        $this->setName('tomkon:assignfiles')
            ->setDefinition([$argument])   // Die Parameter werden als Array übergeben, so kann es mehr als ein geben.
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
        // Hier wird der Kommandozeilenparameter ausgelesen.
        $name = $input->getArgument('name');
        // Hier wird die eigentliche Verarbeitung auf gerufen.
        $this->demoOutput($name);
        if (!empty($this->rows)) {
            $this->io->newLine();
            $this->io->table(['', 'Ouput', 'Target / Error'], $this->rows);
        }
        return $this->statusCode;
    }
    protected function demoOutput($name): void
    {
        // Hier findet die eigentliche Verarbeitung statt.
        // Normalerweise würde hier z.B. ein Event aufgerufen.
        $this->io->text("Hallo $name!");
    }
}
