=== Plugin Name ===
Contributors: robertcalise
Tags: infusionsoft, analytics, web tracking code, marketing automation
Requires at least: 2.7.0
Tested up to: 4.7.2
Stable tag: 1.1

Simple interface to insert Infusionsoft's Web Tracking Code to your WordPress site.

== Description ==

This plugin provides a simple method for Infusionsoft® users to add their Infusionsoft Tracking Code to a WordPress-powered site.

== Installation ==

1. Upload the `infusionsoft-web-tracking-code` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Click 'Settings' > 'Infusionsoft Web Tracking' in your WordPress sidebar
4. Paste in your Infusionsoft App Name and click "Save Changes"
5. You're done!

== Frequently Asked Questions ==

= Where can I find my Infusionsoft App Name? =

Your Infusionsoft App Name is whatever comes before ".infusionsoft.com" when you are logging into your application. For example, if you log into "example.infusionsoft.com," then your Infusionsoft App Name would be "example".

= Wait, I don't have Infusionsoft! =

This plugin is specifically designed to work with Infusionsoft and won't function properly without it. If you'd like to learn more about Infusionsoft, visit [my website](https://robertcalise.com/infusionsoft/) to request more information. 

== Changelog ==

= 1.1 =
* Remove "code" from settings
* Move to Settings menu
* Update image used in example
* Update tracking code to newer version
* Use wp_enqueue_script instead of <script> tag
* Add admin notice when setting is blank
* Updated coding standards
* Change plugin ownership
* Update README text and links

= 1.0 =
* Initial Version