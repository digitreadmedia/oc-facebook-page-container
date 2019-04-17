<?php namespace DigitreadMedia\FacebookPagePlugin\Components;

use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use DigitreadMedia\FacebookPagePlugin\Models\Settings;
use DigitreadMedia\FacebookPagePlugin\Classes\FacebookContainer;

/**
 * Facebook Page Container Class
 * Author: Amanda Benade
 * Company: Digitread Media
 * E-Mail: info@digitread.co.za
 * Last Edited: 17 April 2019
 * Licence: MIT
 */
class MakeContainer extends ComponentBase
{
    /**
     * The plugin settings
     */
    public $settings;
    
    /**
     * A container to display
     */
    public $container;

    public function componentDetails()
    {
        return [
            'name'        => 'digitreadmedia.facebookpageplugin::lang.makecontainer',
            'description' => 'digitreadmedia.facebookpageplugin::lang.makecontainer_description'
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
            'href' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.fbpageurl',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_href_description',
                'type'          => 'string',
                'default'       => 'default',
            ],
            'width' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.override_width',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_width_description',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'digitreadmedia.facebookpageplugin::lang.valid_width',
                'type'          => 'string',
                'default'       => 0,
            ],
            'height' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.override_height',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_height_description',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'digitreadmedia.facebookpageplugin::lang.valid_height',
                'type'          => 'string',
                'default'       => 0,
            ],
            'lang' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.lang',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_lang_description',
                'type'          => 'string',
                'default'       => 'default',
            ],
            'adapt_container_width' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.override_adapt',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_adapt_description',
                'type'          => 'dropdown',
                'default'       => 'default',
                'placeholder'   => 'Select Value',
                'options'       => ['default'=>'Default', '1'=>'Yes','0'=>'No'],                
            ],
            'show_facepile' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.faces',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_default',
                'type'          => 'dropdown',
                'default'       => 'default',
                'placeholder'   => 'Select Value',
                'options'       => ['default'=>'Default', '1'=>'Yes','0'=>'No'],                
            ],            
            'small_header' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.smallheader',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_default',
                'type'          => 'dropdown',
                'default'       => 'default',
                'placeholder'   => 'Select Value',
                'options'       => ['default'=>'Default', '1'=>'Yes','0'=>'No'],                
            ],
            'hide_cover' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.coverphoto',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_default',
                'type'          => 'dropdown',
                'default'       => 'default',
                'placeholder'   => 'Select Value',
                'options'       => ['default'=>'Default', '1'=>'Yes','0'=>'No'],                
            ],     
            'hide_cta' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.hide_cta',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_default',
                'type'          => 'dropdown',
                'default'       => 'default',
                'placeholder'   => 'Select Value',
                'options'       => ['default'=>'Default', '1'=>'Yes','0'=>'No'],                
            ],     
            'override_tabs' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.override_tabs',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_default',
                'type'          => 'checkbox',
            ],       
            'override_messages' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.override_messages',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_default',
                'type'          => 'checkbox',
            ],         
            'override_events' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.override_events',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_default',
                'type'          => 'checkbox',
            ],        
            'override_timeline' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.override_timeline',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_default',
                'type'          => 'checkbox',
            ],     
            'taborder' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.override_taborder',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_default',
                'type'          => 'string',
                'default'       => 'timeline,messages,events',
            ], 
            'use_sdk' => [
                'title'         => 'digitreadmedia.facebookpageplugin::lang.tag_sdk',
                'description'   => 'digitreadmedia.facebookpageplugin::lang.override_default',
                'type'          => 'dropdown',
                'default'       => 'default',
                'placeholder'   => 'Select Value',
                'options'       => ['default'=>'Default', 'iframe'=>'Iframe','sdk'=>'JavaScript SDK'],                
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
        $taborder = explode(",",$this->property('taborder'));
        
        if($this->property('fb_app_id') == 'default') {$params['fb_app_id'] = $settings->fb_app_id;} else {$params['fb_app_id'] = $this->property('fb_app_id');}
        if($this->property('href') == 'default') {$params['href'] = $settings->href;} else {$params['href'] = $this->property('href');}
        if($this->property('width') == 0) {$params['width'] = $settings->width > 179?$settings->width:340;} else {$params['width'] = $this->property('width') > 179?$this->property('width'):340;}
        if($this->property('height') == 0) {$params['height'] = $settings->height > 69?$settings->height:500;} else {$params['height'] = $this->property('height') > 69?$this->property('height'):500;}
        if($this->property('lang') == 'default') {$params['lang'] = $settings->lang;} else {$params['lang'] = $this->property('lang');}
        if($this->property('adapt_container_width') == 'default') {
            $params['responsive'] = $settings->adapt_container_width;
        } else {
            $params['responsive'] = $this->property('adapt_container_width');
        }
        if($this->property('show_facepile') == 'default') {
            $params['show_facepile'] = $settings->show_facepile;
        } else {
            $params['show_facepile'] = $this->property('show_facepile');
        }        
        if($this->property('small_header') == 'default') {
            $params['small_header'] = $settings->small_header;
        } else {
            $params['small_header'] = $this->property('small_header');
        }        
        if($this->property('hide_cover') == 'default') {
            $params['hide_cover'] = $settings->hide_cover;
        } else {
            $params['hide_cover'] = $this->property('hide_cover');
        } 
        if($this->property('hide_cta') == 'default') {
            $params['hide_cta'] = $settings->hide_cta;
        } else {
            $params['hide_cta'] = $this->property('hide_cta');
        } 

        if($this->property('override_tabs') == 1) {
            $tabs = [];
            if($this->property('override_messages')) {$tabs[] = 'messages';}
            if($this->property('override_events')) {$tabs[] = 'events';}
            if($this->property('override_timeline')) {$tabs[] = 'timeline';}
            
        }
        else {
            $tabs = $settings->tabs;
        }
        
        $params['tabs'] = array_intersect_key($taborder,$tabs);
        if($this->property('use_sdk') == 'default') {$params['use_sdk'] = $settings->use_sdk;} else {$params['use_sdk'] = $this->property('use_sdk');}
        
        $this->container = $this->page['container'] = $this->generateHtml($params);
    }

    protected function generateHtml($params)
    {
        $disable = false;
        if($this->settings['disable']==1) {$disable = true;}

        $container = new FacebookContainer($params['fb_app_id'],$params['href'],$params['use_sdk'],$disable);
        $container->setWidth($params['width']);
        $container->setHeight($params['height']);
        $container->setLang($params['lang']);
        $container->setResponsive($params['responsive']);
        $container->showFacepile($params['show_facepile']);
        $container->smallHeader($params['small_header']);
        $container->hideCover($params['hide_cover']);
        $container->hideCta($params['hide_cta']);
        $container->hideCta($params['hide_cta']);
        $container->tabs($params['tabs']);
        $container->generate();
        
        return $container->html;
    }

}
