<?php

namespace Piwik\Plugins\ProfileAvatar;

use Piwik\Plugins\Live\VisitorDetailsAbstract;

class VisitorDetails extends VisitorDetailsAbstract
{
    public function initProfile($visits, &$profile)
    {
        $settings = new UserSettings();
        $visitorID = $profile["visitorId"];
        $hash = hash("sha256", $visitorID);

        if ($settings->dataURLs->getValue()) {
            $chosenGenerator = $settings->avatarType->getValue();
            $generator = GeneratorCollection::getGeneratorClasses($chosenGenerator, $hash);
            $profile['visitorAvatar'] = $generator->asDataUrl();
        } else {
            $profile['visitorAvatar'] = "?module=ProfileAvatar&action=getProfileAvatar&hash=$hash";
        }
    }
}
