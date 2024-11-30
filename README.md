=== UTM Parameter Persistence ===
Contributors: web3dalex
Tags: utm, analytics, marketing, tracking, localStorage
Requires at least: 5.2
Tested up to: 6.7
Stable tag: 1.0.0
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Track and maintain UTM parameters across your WordPress site using localStorage.

== Description ==

UTM Parameter Persistence is a lightweight plugin that captures UTM parameters from incoming traffic and maintains them across page transitions using localStorage. This is essential for accurate marketing analytics and conversion tracking.

= Key Features =

* Automatically captures UTM parameters from URLs
* Persists UTM data across page transitions using localStorage
* Adds UTM parameters to internal links
* No external dependencies
* Performance optimized

= Use Cases =

* Track marketing campaign effectiveness
* Measure conversion paths
* Analyze user journey from specific sources
* Integration with analytics tools

= Supported UTM Parameters =

* utm_source
* utm_medium
* utm_campaign
* utm_term
* utm_content

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/utm-persistence` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. That's it no further configuration needed. The plugin would append initial utms to all valid anchor tags

== Changelog ==

= 1.0.0 =
* Initial release
* Basic UTM parameter tracking
* localStorage implementation

== Upgrade Notice ==

= 1.0.0 =
Initial release of UTM Parameter Persistence plugin.

== Privacy Policy ==

This plugin stores UTM parameters in the user's browser localStorage. This data remains on the user's device and is not sent to any external services.

The plugin tracks the following parameters:
* utm_source
* utm_medium
* utm_campaign
* utm_term
* utm_content

This data is used for internal analytics and marketing attribution only.
This data is used for internal analytics and marketing attribution only.
