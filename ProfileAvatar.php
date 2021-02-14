<?php

namespace Piwik\Plugins\ProfileAvatar;

use Piwik\DataTable\Row;
use Piwik\Plugin;

class ProfileAvatar extends Plugin
{
    public function registerEvents()
    {
        return array(
            'Live.renderVisitorDetails' => 'addImageToTemplate',
        );
    }

    public function addImageToTemplate(string &$outString, Row $visit)
    {
        $settings = new UserSettings();
        if (!$settings->showInVisitorLog->getValue()) {
            return;
        }
        $visitorID = $visit->getColumn("visitorId");
        $hash = hash("sha256", $visitorID);

        $outString .= "<img width='32' height='32' alt='user profile' src='?module=ProfileAvatar&action=getProfileAvatar&hash=$hash' aria-hidden='true'>";
    }
}
