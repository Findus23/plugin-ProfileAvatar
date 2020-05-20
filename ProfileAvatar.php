<?php

namespace Piwik\Plugins\ProfileAvatar;

use Piwik\Plugin;

class ProfileAvatar extends Plugin
{

    public function registerEvents()
    {
        return [
            'Live.getExtraVisitorDetails' => 'getExtraVisitorDetails'
        ];
    }

    public function getExtraVisitorDetails(&$result): void
    {
        $settings = new UserSettings();
        $visitorID = $result["visitorId"];
        $hash = hash("sha256", $visitorID);

        if ($settings->dataURLs->getValue()) {
            $chosenGenerator = $settings->avatarType->getValue();
            $generator = GeneratorCollection::getGeneratorClasses($chosenGenerator,$hash);
            $result['visitorAvatar'] = $generator->asDataUrl();
        } else {
            $result['visitorAvatar'] = "?module=ProfileAvatar&action=getProfileAvatar&hash=$hash";
        }
    }
}
