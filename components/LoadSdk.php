<?php namespace DigitreadMedia\FacebookPagePlugin\Components;

use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use DigitreadMedia\FacebookPagePlugin\Models\Settings;
use DigitreadMedia\FacebookPagePlugin\Classes\FacebookContainer;

/**
 * JavaScript SDK FB Class
 * Author: Amanda Benade
 * Company: Digitread Media
 * E-Mail: info@digitread.co.za
 * Last Edited: 17 April 2019
 * Licence: MIT
 */
class LoadSdk extends ComponentBase
{
    /**
     * The plugin settings
     */
    public $settings;
    
    /**
     * Display SDK
     */
    public $fbheader;

    public function componentDetails()
    {
        return [
            'name'        => 'digitreadmedia.facebookpageplugin::lang.makesdk',
            'description' => 'digitreadmedia.facebookpageplugin::lang.makesdk_description'
        ];
    }

    public function defineProperties()
    {
        return [
            'fb_app_id' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.appid',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_apid_description',
                'type'          => 'string',
                'default'       => 'default',
            ],
            'lang' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.lang',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_lang_description',
                'type'          => 'string',
                'default'       => 'default',
            ],
        ];
    }

    public function onRun()
    {
        $this->prepareVars();

    }

    protected function prepareVars()
    {
        $this->settings = $settings = Settings::instance();

        if($this->property('fb_app_id') == 'default') {$params['fb_app_id'] = $settings->fb_app_id;} else {$params['fb_app_id'] = $this->property('fb_app_id');}
        if($this->property('lang') == 'default') {$params['lang'] = $settings->lang;} else {$params['lang'] = $this->property('lang');}
        $this->fbheader = $this->page['fbheader'] = $this->generateHtml($params);
    }

    protected function generateHtml($params)
    {
        $disable = false;

        $container = new FacebookContainer($params['fb_app_id'],$this->settings->pageUrl,'sdk',$disable);
        $container->loadsdk();
        
        return $container->html;
    }

}
