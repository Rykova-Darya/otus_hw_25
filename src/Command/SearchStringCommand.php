<?php

namespace App\Command;

use App\Services\Func;
use App\Services\SearchBackScan;
use App\Services\SearchBM;
use App\Services\SearchFullScan;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'search:string',
    description: 'Add a short description for your command',
)]
class SearchStringCommand extends Command
{
    public function __construct(private readonly Func $func)
    {
        parent::__construct();
    }

//    protected function configure(): void
//    {
//        $this
//            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
//            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
//        ;
//    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $text = "ВЕСНАПРИДШЛАВЕСНЕДОРОГУ";
        $mask = "ВЕСНЕ";
        $n = 100;
        $startTime = microtime(true);
        //Полное сканирование
        for ($i = 1; $i <= 100; $i++) {
            $this->func->search($text, $mask, SearchFullScan::class);
        }
        $endTime = microtime(true);
        $resultTime1 = ($endTime - $startTime) / 100;

        $startTime = microtime(true);
        //Обратное сканирование
        for ($i = 1; $i <= 100; $i++) {
            $this->func->search($text, $mask, SearchBackScan::class);
        }

        $endTime = microtime(true);
        $resultTime2 = ($endTime - $startTime) / 100;



        $startTime = microtime(true);
        //Алгоритм Бойера-Мура
        $search = new SearchBM($text, $mask);
        for ($i = 1; $i <= 100; $i++) {
            $search->getResultSearchBM();
        }
        $endTime = microtime(true);
        $resultTime3 = ($endTime - $startTime) / 100;

        $this->func->search($text, $mask, SearchFullScan::class);
        echo $resultTime1 . PHP_EOL;
        $this->func->search($text, $mask, SearchBackScan::class);
        echo $resultTime2 . PHP_EOL;
        $search->getResultSearchBM();
        echo $resultTime3 . PHP_EOL;

        return Command::SUCCESS;
    }
}
