<?php

namespace Piwik\Plugins\ProfileAvatar\Generators;

/**
 * PHP port of Blockies
 * https://github.com/download13/blockies
 * by Erin Dachtler, Alex Van de Sande
 * MIT license / WTFPL license
 */
class Blockies extends PixelBased
{
    protected $size = 100;
    protected $singleColor = FALSE;
    private $rowscols = 10;

    protected function createPatterns(): void
    {
        srand(hexdec(substr($this->seed, -10)));
        $colors = [$this->createColor(), $this->createColor(), $this->createColor()];
        $cell = $this->size / $this->rowscols;
        for ($j = 0; $j < $this->rowscols; $j++) {

            $values = $this->createRow();
            $values = array_merge($values, array_reverse($values));
            $i = 0;
            foreach ($values as $value) {
                $this->rectangles[] = [
                    "x" => $i * $cell,
                    "y" => $j * $cell,
                    "w" => $cell,
                    "h" => $cell,
                    "color" => $colors[$value]
                ];
                $i += 1;
            }
        }
        srand();
    }

    private function createColor(): array
    {
        $h = rand(0, 360) / 360;
        $s = rand(40, 100) / 100;
        $l = ($this->rand() + $this->rand() + $this->rand() + $this->rand()) * 25 / 100;
        return [$h, $s, $l];
    }

    private function rand(): float
    {
        return mt_rand() / mt_getrandmax();
    }

    private function createRow(): array
    {
        for ($i = 0; $i < $this->rowscols / 2; $i++) {
            $row[] = floor($this->rand() * 2.3);
        }
        return $row;
    }

    protected function getForegroundColor(): void
    {
        return;
    }
}
