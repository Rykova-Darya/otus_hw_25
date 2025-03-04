<?php

namespace App\Services;

class SearchFullScan extends Search
{

    public function __construct($text, $mask, $name = 'Алгоритм полного перебора')
    {
        parent::__construct($text, $mask, $name);
    }

    public function run()
    {
        $this->cmp = 0;
        $textArray = mb_str_split($this->text);
        $maskArray = mb_str_split($this->mask);

        $textLen = count($textArray);
        $maskLen = count($maskArray);

        $t = 0;
        while ($t <= ($textLen - $maskLen)) {
            $m = 0;
            while ($m < $maskLen && $textArray[$t + $m] == $maskArray[$m]) {
                $this->cmp++;
                $m++;
            }
            if ($m == $maskLen) {
                return $t;
            }
            $t++;
        }
        return -1;
    }
}