<?php

namespace Piwik\Plugins\ProfileAvatar\Generators;

/**
 * PHP port of https://github.com/stewartlord/identicon.js
 * Copyright (c) 2018, Stewart Lord
 * BSD 2-Clause
 */
class Identicon extends PixelBased
{
    private $margin = 0.08;
    private $saturation = 0.7;
    private $lightness = 0.5;


    protected function createPatterns(): void
    {
        $baseMargin = floor($this->size * $this->margin);
        $cell = floor(($this->size - ($baseMargin * 2)) / 5);
        $margin = floor(($this->size - $cell * 5) / 2);

        for ($i = 0; $i < 15; $i++) {
            $color = hexdec($this->seed[$i]) % 2 ? $this->backgroundColor : $this->getForegroundColor();
            if ($i < 5) {
                $this->rectangles[] = [
                    "x" => 2 * $cell + $margin,
                    "y" => $i * $cell + $margin,
                    "w" => $cell,
                    "h" => $cell,
                    "color" => $color
                ];
            } elseif ($i < 10) {
                $this->rectangles[] = [
                    "x" => 1 * $cell + $margin,
                    "y" => ($i - 5) * $cell + $margin,
                    "w" => $cell,
                    "h" => $cell,
                    "color" => $color
                ];
                $this->rectangles[] = [
                    "x" => 3 * $cell + $margin,
                    "y" => ($i - 5) * $cell + $margin,
                    "w" => $cell,
                    "h" => $cell,
                    "color" => $color
                ];
            } elseif ($i < 15) {
                $this->rectangles[] = [
                    "x" => 0 * $cell + $margin,
                    "y" => ($i - 10) * $cell + $margin,
                    "w" => $cell,
                    "h" => $cell,
                    "color" => $color
                ];
                $this->rectangles[] = [
                    "x" => 4 * $cell + $margin,
                    "y" => ($i - 10) * $cell + $margin,
                    "w" => $cell,
                    "h" => $cell,
                    "color" => $color
                ];
            }
        }

    }

    protected function getForegroundColor(): array
    {
        $hue = hexdec(substr($this->seed, -7)) / 0xfffffff;
        return [$hue * 360, $this->saturation, $this->lightness];
    }


}
