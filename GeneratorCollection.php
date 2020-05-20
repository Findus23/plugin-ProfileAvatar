<?php


namespace Piwik\Plugins\ProfileAvatar;

use Piwik\Plugins\ProfileAvatar\Generators\AvatarBase;
use Piwik\Plugins\ProfileAvatar\Generators\BirdAvatar;
use Piwik\Plugins\ProfileAvatar\Generators\Blockies;
use Piwik\Plugins\ProfileAvatar\Generators\CatAvatar;
use Piwik\Plugins\ProfileAvatar\Generators\Identicon;
use Piwik\Plugins\ProfileAvatar\Generators\MonsterID;

class GeneratorCollection
{
    static public $generatorNames = [
        "CatAvatar" => "Cat Avatar",
        "BirdAvatar" => "Bird Avatar",
        "MonsterID" => "MonsterID",
        "Identicon" => "Identicon.js",
        "Blockies" => "Blockies"
    ];

    static public function getGeneratorClasses(string $name, string $hash): AvatarBase
    {
        switch ($name) {
            case "CatAvatar":
                return new CatAvatar($hash);
                break;
            case "BirdAvatar";
                return new BirdAvatar($hash);
                break;
            case "MonsterID":
                return new MonsterID($hash);
                break;
            case "Identicon":
                return new Identicon($hash);
                break;
            case "Blockies":
                return new Blockies($hash);
                break;
            default:
                throw new \Exception("invalid Generator");
        }
    }
}
