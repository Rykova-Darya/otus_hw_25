<?php

namespace App\Services;

class SearchBackScan extends Search {
    public function __construct($text, $mask) {
        parent::__construct($text, $mask, "Алгоритм обратного сравнения");
    }

//    public function run() {
//        $t = 0;
//        $this->cmp = 0;
//
//        while ($t <= (mb_strlen($this->text) - mb_strlen($this->mask))) {
//            $m = mb_strlen($this->mask) - 1;
//            while ($m >= 0 && $this->text[$t + $m] == $this->mask[$m]) {
//                $this->cmp++;
//                $m--;
//            }
//            if ($m < 0) {
//                return $t;
//            }
//            $t++;
//        }
//        return -1;
//    }

    public function run() {
        $t = 0;
        $this->cmp = 0;
        $textArray = mb_str_split($this->text);
        $maskArray = mb_str_split($this->mask);

        $textLen = count($textArray);
        $maskLen = count($maskArray);

        while ($t <= $textLen - $maskLen) {
            $m = $maskLen - 1;
            while ($m >= 0 && $textArray[$t + $m] == $maskArray[$m]) {
                $this->cmp++;
                $m--;
            }
            if ($m < 0) {
                return $t;
            }
            $t++;
        }
        return -1;
    }
}