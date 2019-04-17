<?php namespace DigitreadMedia\FacebookPagePlugin;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'DigitreadMedia\FacebookPagePlugin\Components\MakeContainer' => 'FB',
            'DigitreadMedia\FacebookPagePlugin\Components\LoadSdk' => 'SDK',
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Facebook Page Plugin',
                'description' => 'Manage Facebook Page plugin settings.',
                'category'    => 'Social',
                'icon'        => 'icon-facebook-square',
                'class'       => 'DigitreadMedia\FacebookPagePlugin\Models\Settings',
                'order'       => 500,
                'keywords'    => 'facebook page plugin',
                'permissions' => ['digitreadmedia.facebookpageplugin.access_settings']
            ]
        ];
    }
    
    public function registerPermissions()
    {
        return [
            'digitreadmedia.facebookpageplugin.manage_settings' => [
                'tab' => 'digitreadmedia.facebookpageplugin::lang.plugin.name',
                'label' => 'digitreadmedia.facebookpageplugin::lang.plugin.manage_settings']
        ];
    }    
}
