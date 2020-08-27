<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Helper\Table;
use App\Entity\SequenceCalc;
use \App\Validator\Constraints\SequenceTextareaValidator;


class SequenceCalcCommand extends Command
{
    protected static $defaultName = 'app:sequence-calc';
    
    protected function configure()
    {
        $this
            ->setDescription('Wylicza maksimum z ciagu dla n')
            ->setHelp(
                'Komenda dla liczb całkowitych z zakresu od 1 do 99999 wylicza wartość maksymalną ciągu. '
                . 'Maksymalnie 10 probek.'
            )
            ->addArgument(
                'filename',
                InputArgument::OPTIONAL,
                'Plik z danymi do obliczeń. Każda liczba w nowej linii'
            )
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        
        $filename = $input->getArgument('filename');
        if ($filename !== null) {
            if (file_exists($filename)) {
                $text = file_get_contents($filename, false, null, 0, 1024);
            } else {
                $output->writeln("Nie można odczytać pliku " . $filename);
                return 1;
            }
        } else {
            $text = stream_get_contents(STDIN, 1024);
        }
        
        $text = trim($text);
        
        if (count(explode("\n", $text)) > 10) {
            $output->writeln("Wprowadzono więcej niż 10 wierszy.");
            return 1;
        }
        
        $seq = new SequenceCalc(new SequenceTextareaValidator());
        $seq->setText($text);
        if ($seq->processText() === false) {
            $output->writeln("Wprowadzono więcej niż 10 wierszy.");
            return 1;
        }
     
        $table = new Table($output);
        $table->setHeaders(['INPUT', 'OUTPUT']);
        $table->setRows($seq->getTable());
        $table->render();

        return 0;
    }
}
