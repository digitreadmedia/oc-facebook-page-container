<?php namespace DigitreadMedia\FacebookPagePlugin\Models;

use Model;
/**
 * Facebook Page Container Settings
 * Author: Amanda Benade
 * Company: Digitread Media
 * E-Mail: info@digitread.co.za
 * Last Edited: 17 April 2019
 * Licence: MIT
 */
class Settings extends Model
{
    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'digitreadmedia_facebookpageplugin_settings';

    public $settingsFields = 'settings.yaml';
    

}
?>