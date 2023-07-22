<?php

namespace Piwik\Plugins\ProfileAvatar;

use Piwik\Piwik;

class Controller extends \Piwik\Plugin\Controller
{
    /**
     * Get profile Avatar
     */
    public function getProfileAvatar(): void
    {
        Piwik::checkUserHasSomeViewAccess();
        $request = \Piwik\Request::fromRequest();
        $hash = $request->getStringParameter('hash', "");
        $settings = new UserSettings();
        $chosenGenerator = $settings->avatarType->getValue();
        $generator = GeneratorCollection::getGeneratorClasses($chosenGenerator, $hash);
        $generator->print();
        exit();
    }
}
