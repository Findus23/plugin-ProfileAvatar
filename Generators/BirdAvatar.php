<?php

namespace Piwik\Plugins\ProfileAvatar\Generators;

/**
 * based on cat-avatar-generator by David Revoy
 * Artwork license: https://creativecommons.org/licenses/by/4.0/
 */
class BirdAvatar extends MonsterIDBase
{
    public $size = 240;
    protected $path = "CatAvatar/Bird";
    protected $partTemplate = [
        'tail' => [1, 9],
        'hoop' => [1, 9],
        'body' => [1, 9],
        'wing' => [1, 9],
        'eyes' => [1, 9],
        'bec' => [1, 9],
        'accessorie' => [1, 20]
    ];

}
