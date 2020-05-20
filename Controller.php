<?php

namespace Piwik\Plugins\ProfileAvatar;

use Piwik\Common;
use Piwik\Piwik;

class Controller extends \Piwik\Plugin\Controller
{
    /**
     * Get profile Avatar
     */
    public function getProfileAvatar(): void
    {
        Piwik::checkUserHasSomeViewAccess();
        $hash = Common::getRequestVar('hash', "", 'string');
        $settings = new UserSettings();
        $chosenGenerator = $settings->avatarType->getValue();
        $generator = GeneratorCollection::getGeneratorClasses($chosenGenerator, $hash);
        $generator->print();
        exit();
    }
}
