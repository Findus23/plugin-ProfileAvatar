<?php

namespace Piwik\Plugins\ProfileAvatar\Generators;


abstract class AvatarBase
{
    abstract function build();

    abstract function print();

    abstract function asDataURL();
}
