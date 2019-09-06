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
        $parameterHelp  = 'Verzeichnis unterhalb des Contao-Verzeichnisses, welches durchsucht werden soll.';
        $argument       = new InputArgument('path', InputArgument::REQUIRED, $parameterHelp);
        $this->setName('tomkon:assignfiles')
            ->setDefinition([$argument])
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

        */
        $path = $input->getArgument('path');
        // Hier wird die eigentliche Verarbeitung auf gerufen.
        $this->assignFiles($path);
        if (!empty($this->rows)) {
            $this->io->newLine();
            $this->io->table(['', 'Ouput', 'Target / Error'], $this->rows);
        }
        return $this->statusCode;
    }

    function getDirContents($dir, &$results = array()){
        $files = scandir($dir);

        foreach($files as $key => $value){
            $path = realpath($dir.DIRECTORY_SEPARATOR.$value);
            if(!is_dir($path)) {
                $results[] = $path;
            } else if($value != "." && $value != "..") {
                getDirContents($path, $results);
                $results[] = $path;
            }
        }

        return $results;
    }

    protected function assignFiles($path): void
    {
        $rootDir = $this->getContainer()->getParameter('kernel.project_dir');
        $dir = $rootDir."/".$path;
        // Hier findet die eigentliche Verarbeitung statt.
        // Normalerweise würde hier z.B. ein Event aufgerufen.
//        \Dbafs::addResource($filepath);
//        $files = $this->getDirContents($dir);
        \Dbafs::syncFiles();

        $files = \FilesModel::findByPath($path);

        foreach($files as $file) {
            //\Dbafs::addResource($file);
            $this->io->text($file);
        }




    }
}
