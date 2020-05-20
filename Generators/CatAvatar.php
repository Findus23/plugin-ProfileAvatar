<?php

namespace Piwik\Plugins\ProfileAvatar\Generators;


class CatAvatar extends MonsterIDBase
{
    public $size = 240;
    protected $path = "CatAvatar/Cat";
    protected $partTemplate = [
        'body' => [1, 15],
        'fur' => [1, 10],
        'eyes' => [1, 15],
        'mouth' => [1, 10],
        'accessorie' => [1, 20]
    ];

}
