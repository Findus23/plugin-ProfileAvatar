<?php

namespace Piwik\Plugins\ProfileAvatar\Generators;

/**
 * Artwork by Andreas Gohr, code based on work by Andreas Gohr
 * https://github.com/splitbrain/monsterID
 * licenced under MIT license
 */
class MonsterID extends MonsterIDBase
{
    protected $path = "monsterID";
    protected $partTemplate = [
        'legs' => [1, 5],
        'hair' => [1, 5],
        'arms' => [1, 5],
        'body' => [1, 15],
        'eyes' => [1, 15],
        'mouth' => [1, 10],
    ];

    protected function applyPartToImage($part, $number): void
    {
        parent::applyPartToImage($part, $number);
        if ($part == 'body') {
            $color = imagecolorallocate($this->monster, rand(20, 235), rand(20, 235), rand(20, 235));
            imagefill($this->monster, 60, 60, $color);
        }
    }
}
