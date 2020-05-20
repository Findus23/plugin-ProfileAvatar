<?php

namespace Piwik\Plugins\ProfileAvatar\Generators;

/**
 * Based on ported code by Erin Dachtler and Stewart Lord
 * Copyright (c) 2018, Stewart Lord
 * BSD 2-Clause
 * MIT license / WTFPL
 * https://github.com/stewartlord/identicon.js
 * https://github.com/download13/blockies
 */
abstract class PixelBased extends AvatarBase
{
    protected $seed;
    protected $rectangles = [];
    protected $backgroundColor = [0, 0, 0.94];
    protected $size = 64;
    protected $singleColor = TRUE;

    public function __construct($seed = null)
    {
        $this->seed = $seed;
    }

    public function asDataURL()
    {
        $svg = $this->build();

        return "data:image/svg+xml," . rawurlencode($svg);
    }

    public function build()
    {
        $this->createPatterns();
        return $this->createSVG();
    }

    abstract protected function createPatterns();

    protected function createSVG()
    {
        $bg = $this->toSVGColor($this->backgroundColor);
        $stroke = $this->size * 0.005;
        $svg = "<svg xmlns='http://www.w3.org/2000/svg' width='$this->size' height='$this->size' style='background: $bg'>";
        if ($this->singleColor) {
            $fg = $this->toSVGColor($this->getForegroundColor());
            $svg .= "<g style='fill: $fg; stroke: $fg' stroke-width='$stroke'>";
        } else {
            $svg .= "<g stroke-width='$stroke'>";
        }

        foreach ($this->rectangles as $rectangle) {
            $x = $rectangle["x"];
            $y = $rectangle["y"];
            $w = $rectangle["w"];
            $h = $rectangle["h"];
            if ($rectangle["color"] == $this->backgroundColor) {
                continue;
            }
            if ($this->singleColor) {
                $svg .= "<rect x='$x' y='$y' width='$w' height='$h' />\n";
            } else {
                $color = $this->toSVGColor($rectangle["color"]);
                $svg .= "<rect x='$x' y='$y' width='$w' height='$h' style='fill: $color; stroke: $color' />\n";
            }
        }
        $svg .= "</g></svg>";
        return $svg;
    }

    protected static function toSVGColor(array $color)
    {
        list($h, $s, $l) = $color;
        $h *= 360;
        $s *= 100;
        $l *= 100;
        $h=round($h);
        $s=round($s);
        $l=round($l);
        return "hsl($h, $s%, $l%)";
    }

    abstract protected function getForegroundColor();

    public function print()
    {
        header('Content-type:image/svg+xml;charset=utf-8');
        echo $this->build();
    }

}
