<?php
/**
 * Matomo - free/libre analytics platform
 *
 * @link https://matomo.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Plugins\ProfileAvatar;

use Piwik\Piwik;
use Piwik\Settings\FieldConfig;
use Piwik\Settings\Setting;

class UserSettings extends \Piwik\Settings\Plugin\UserSettings
{
    /** @var Setting */
    public $avatarType;

    /** @var Setting */
    public $dataURLs;

    protected $title = "Visitor Profile Avatar";

    protected function init()
    {
        $this->avatarType = $this->createAvatarTypeSetting();

        $this->dataURLs = $this->createDataURLsSetting();
    }

    private function createAvatarTypeSetting():Setting
    {
        return $this->makeSetting("avatarType", "CatAvatar", FieldConfig::TYPE_STRING, function (FieldConfig $field) {
            $field->title = Piwik::translate('ProfileAvatar_AvatarTypeTitle');;
            $field->uiControl = FieldConfig::UI_CONTROL_RADIO;
            $field->description = Piwik::translate('ProfileAvatar_AvatarTypeDescription');
            $field->availableValues = GeneratorCollection::$generatorNames;
        });
    }

    private function createDataURLsSetting():Setting
    {
        return $this->makeSetting("dataURLs", FALSE, FieldConfig::TYPE_BOOL, function (FieldConfig $field) {
            $field->title = Piwik::translate('ProfileAvatar_DataURLsTitle');
            $field->uiControl = FieldConfig::UI_CONTROL_CHECKBOX;
            $field->description = Piwik::translate('ProfileAvatar_DataURLsDescription');
        });
    }
}
