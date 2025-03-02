<?php

namespace App\Services;

class Func
{
    public function search($text, $mask, $className) {


        $searches = array_fill(0, 5, null);
        $searches[0] = new $className($text, $mask);

        for ($i = 0; $i < count($searches); $i++) {
            if ($searches[$i] === null) {
                break;
            }
            echo "---------------------------------------\n";
            echo $searches[$i]->getName() . PHP_EOL;
            echo "Позиция: " . $searches[$i]->run() . PHP_EOL;
            echo "Количество сравнений: " . $searches[$i]->getCompares() . PHP_EOL;
        }
    }
}