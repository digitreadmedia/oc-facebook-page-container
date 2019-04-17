<?php namespace DigitreadMedia\FacebookPagePlugin\Classes;

/**
 * Facebook Page Plugin
 * Author: Amanda Benade
 * Company: Digitread Media
 * E-Mail: info@digitread.co.za
 * Last Edited: 17 April 2019
 * Licence: MIT
 */
 class FacebookContainer 
 {
        /**
         * Required Facebook App ID
         * Get your App ID at developers.facebook.com
         */
        protected $fb_app_id;
        protected $href; 
        protected $pagename;
        protected $width = 340; 
        protected $height = 500; 
        protected $lang = "en_US"; 
        protected $adapt_container_width = true; 
        protected $show_facepile = true; 
        protected $small_header = true; 
        protected $hide_cover = false; 
        protected $hide_cta = true; 
        protected $tabs = ['timeline']; 
        protected $use_sdk = 'iframe'; 
        public $html;

        /**
         * @var string $fb_app: Facebook App ID
         * @var string $pageUrl: Facebook Page URL. Required.
         * @var string $type: Use Iframe or JavaScript SDK (iframe / sdk)
         * @var boolean $disabled: Set to true if your server has allow_url_fopen disabled
         * @throw ValueError
         */
        public function __construct($fb_app,$pageUrl,$type='iframe',$disabled=false) 
        {
            $url = "https://www.facebook.com/".$pageUrl;

            if(DigitreadMediaLibrary::validateUrl($url,$disabled,'facebook.com')) 
            {
                $this->fb_app_id = $fb_app;
                $this->pageName = $pageUrl;
                $this->href = $url;
                $this->use_sdk = $type;
            }
            
        }
        
        /**
         * Generate the container
         */
        public function generate() 
        {
            $container = [];
            switch($this->use_sdk) 
            {
                case 'sdk':
                    $container['body'] = $this->sdkBody();
                    break;
                case 'iframe':
                default:
                    $container['body'] = $this->makeIframe();
                    break;
            }
            
            if(count($container) < 1) {
                throw new \Exception('There was an error creating the container.');
            }
            
            $this->html = $container;
            return $this->html;
            
        }
        
        public function loadsdk() 
        {
            $container['head'] = $this->sdkBodyTag();

            if(count($container) < 1) {
                throw new \Exception('There was an error creating the SDK header.');
            }
            
            $this->html = $container;
            return $this->html;
            
        }
        
        
        //Generate the container iframe
        protected function makeIframe() 
        {
            $tabs = implode("%2C%20",$this->tabs);
            $html = '<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2F'.$this->pageName.'%2F&tabs='.$tabs.'&width='.$this->width;
            $html .= '&height='.$this->height.'&small_header='.$this->small_header.'&adapt_container_width='.$this->adapt_container_width.'&hide_cover='.$this->hide_cover;
            $html .= '&show_facepile='.$this->show_facepile.'&data-hide-cta='.$this->hide_cta.'&appId='.$this->fb_app_id.'" width="'.$this->width.'" height="'.$this->height.'"';
            $html .= 'style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>';
            return $html;
        }
        
        //Generate the JavaScript SDK code to be placed below the <body> tag
        protected function sdkBodyTag() 
        {
            $html = '<div id="fb-root"></div>';
            $html .= '<script async defer crossorigin="anonymous" src="https://connect.facebook.net/'.$this->lang.'/sdk.js#xfbml=1&version=v3.2&appId='.$this->fb_app_id.'&autoLogAppEvents=1"></script>';
            return $html;
        }
        
        //Generate the JavaScript SDK container
        protected function sdkBody() 
        {
            $tabs = implode(",",$this->tabs);
            $html = '<div class="fb-page" data-href="'.$this->href.'" data-tabs="'.$tabs.'" data-width="'.$this->width.'" data-height="'.$this->height.'" ';
            $html .= 'data-small-header="'.$this->small_header.'" data-adapt-container-width="'.$this->adapt_container_width.'" ';
            $html .= 'data-hide-cover="'.$this->hide_cover.'" data-show-facepile="'.$this->show_facepile.'" data-hide-cta="'.$this->hide_cta.'"></div>';
            return $html;
        }
        
        //Integer - Min. 180px & max. 500px
        public function setWidth(int $width) 
        {
            if($width > 179) 
            {
                $this->width = $width;
            }
        }
        
        //Integer - Min. 70px 
        public function setHeight(int $height) 
        {
            if($height > 69) 
            {
                $this->height = $height;
            }
        }
        
        //Language locale code eg. en_US
        public function setLang($lang) 
        {
            if(in_array($lang,DigitreadMediaLibrary::localeList())) 
            {
                $this->lang = $lang;
            }
        }

        //Adapt container width Boolean true/false
        public function setResponsive(bool $bool) 
        {
            $this->adapt_container_width = DigitreadMediaLibrary::booltxt($bool);
        }   
        
        //Show friends' faces Boolean true/false
        public function showFacepile(bool $bool) 
        {
            $this->show_facepile = DigitreadMediaLibrary::booltxt($bool);
        }  
        
        //Use small page header /Boolean true/false
        public function smallHeader(bool $bool) 
        {
            $this->small_header = DigitreadMediaLibrary::booltxt($bool);
        }   
        
        //Hide page cover Boolean true/false
        public function hideCover(bool $bool) 
        {
            $this->hide_cover = DigitreadMediaLibrary::booltxt($bool);
        } 

        // Hide custom call to action button Boolean true/false
        public function hideCta(bool $bool) 
        {
            $this->hide_cta = DigitreadMediaLibrary::booltxt($bool);
        }
        
        // Show tabs Array ['timeline','events','messages']
        public function tabs(array $tabs) 
        {
            $this->tabs = $tabs;
        }
        
 }