<?php

namespace App\Services;

//class SearchBM {
//    private $text;
//    private $mask;
//    private $suffix;
//    private $cmp;
//    private $algorithmName = "Алгоритм Бойера-Мура";
//
//    public function __construct($text, $mask) {
//        $this->text = $text;
//        $this->mask = $mask;
//    }
//
//    public function prepare() {
//        $this->suffix = array_fill(0, mb_strlen($this->mask), 0);
//        $this->suffix[0] = 1;
//
//        for ($i = 1; $i < mb_strlen($this->mask); $i++) {
//            for ($k = 1; $k <= mb_strlen($this->mask); $k++) {
//                $cnt = 0;
//
//                for ($j = 0; $j < $i; $j++) {
//                    if (($j + $k + 1) > mb_strlen($this->mask)) {
//                        break;
//                    }
//
//                    if ($this->mask[mb_strlen($this->mask) - 1 - $j] != $this->mask[strlen($this->mask) - 1 - $j - $k]) {
//                        break;
//                    }
//
//                    $cnt++;
//                }
//
//                if ($cnt < $i) {
//                    if (($k + $cnt) == mb_strlen($this->mask)) {
//                        $this->suffix[$i] = $k;
//                        break;
//                    }
//                    continue;
//                }
//
//                $this->suffix[$i] = $k;
//                break;
//            }
//        }
//    }
//
//    private function run() {
//        $this->prepare();
//        $t = 0;
//        $this->cmp = 0;
//
//        while ($t <= (mb_strlen($this->text) - mb_strlen($this->mask))) {
//            $m = mb_strlen($this->mask) - 1;
//
//            while ($m >= 0 && $this->text[$t + $m] == $this->mask[$m]) {
//                $this->cmp++;
//                $m--;
//            }
//
//            if ($m < 0) {
//                return $t;
//            }
//
//            $c = mb_strlen($this->mask) - 1 - $m;
//            $t += $this->suffix[$c];
//        }
//
//        return -1;
//    }
//
//    public function getResultSearchBM()
//    {
//        $result = $this->run();
//        echo "---------------------------------------\n";
//        echo $this->algorithmName . PHP_EOL;
//        echo 'Позиция: ' . $result . PHP_EOL;
//        echo 'Количество сравнений: ' . $this->cmp;
//
//    }
//}

class SearchBM {
    private $text;
    private $mask;
    private $suffix;
    private $cmp;
    private $algorithmName = "Алгоритм Бойера-Мура";

    public function __construct($text, $mask) {
        $this->text = mb_str_split($text); // Разбиваем текст на массив символов
        $this->mask = mb_str_split($mask); // Разбиваем шаблон на массив символов
    }

    public function prepare() {
        $maskLen = count($this->mask);
        $this->suffix = array_fill(0, $maskLen, 0);
        $this->suffix[0] = 1;

        for ($i = 1; $i < $maskLen; $i++) {
            for ($k = 1; $k <= $maskLen; $k++) {
                $cnt = 0;

                for ($j = 0; $j < $i; $j++) {
                    if (($j + $k + 1) > $maskLen) {
                        break;
                    }

                    if ($this->mask[$maskLen - 1 - $j] != $this->mask[$maskLen - 1 - $j - $k]) {
                        break;
                    }

                    $cnt++;
                }

                if ($cnt < $i) {
                    if (($k + $cnt) == $maskLen) {
                        $this->suffix[$i] = $k;
                        break;
                    }
                    continue;
                }

                $this->suffix[$i] = $k;
                break;
            }
        }
    }

    private function run() {
        $this->prepare();
        $t = 0;
        $this->cmp = 0;

        $textLen = count($this->text);
        $maskLen = count($this->mask);

        while ($t <= ($textLen - $maskLen)) {
            $m = $maskLen - 1;

            while ($m >= 0 && $this->text[$t + $m] == $this->mask[$m]) {
                $this->cmp++;
                $m--;
            }

            if ($m < 0) {
                return $t;
            }

            $c = $maskLen - 1 - $m;
            $t += $this->suffix[$c];
        }

        return -1;
    }

    public function getResultSearchBM()
    {
        $result = $this->run();
        echo "---------------------------------------\n";
        echo $this->algorithmName . PHP_EOL;
        echo 'Позиция: ' . $result . PHP_EOL;
        echo 'Количество сравнений: ' . $this->cmp . PHP_EOL;
    }
}