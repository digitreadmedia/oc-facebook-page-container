# OC Facebook Page Container Plugin
Display a Facebook widget container on your October CMS website with one or multiple tabs for Messenger, Events or Timeline.

## About This Plugin
Add Facebook interactive features to your website with this plugin:
- Easily configure the plugin features in a default settings page
- Ability to override default settings per component
- Ability to show a single tab or multiple tabs, as well as reorder tabs
- Ability to change the language settings for the JavaScript SDK
- Choose to display either the JavaScript SDK or the IFrame

## Requirements
- You will need to create your own Facebook App ID at https://developers.facebook.com
- The plugin uses URL validation which requires allow_url_fopen to be enabled on your server.  This setting is disabled by default, it can be enabled in the settings page

## Usage
- Install the plugin.
- Navigate to the October CMS settings interface
- Select "Facebook Page Plugin" under "Social"
- Configure the default settings as needed.
- The Facebook Page Username and the App ID is REQUIRED.

**JavaScipt SDK**
- Add the FB JavaScipt SDK component to the layout page right below the <body> tag.
- Add the Facebook Page Container component where you would like the widget to appear.

**OR**

**Iframe**
- Add the Facebook Page Container component where you would like the widget to appear.

**Overriding Settings**
- You can override the Facebook Page Username and App ID in the component settings.
- You can also reorder the tabs in the component settings by re-arranging the comma separated list for "Tab Order".

## Troubleshooting
- If you are having trouble displaying the JavaScript SDK, check your website for JavaScript conflicts.  Also make sure you added the FB JavaScipt SDK component to the layout page right below the <body> tag. If all else fails, try switching to the iframe.
- If neither the iframe and the JavaScript SDK display, try activating URL validation to check if there is an issue with the Facebook URL. (See Requirements above).  Also make sure that the page is published and not restricted by age or country.  
- Please log any issues on GitHub.
