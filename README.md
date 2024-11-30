# UTM Parameter Persistence

Track and maintain UTM parameters across your WordPress site using localStorage. Perfect for marketing analytics and conversion tracking.

## Description

UTM Parameter Persistence is a lightweight plugin that captures UTM parameters from incoming traffic and maintains them across page transitions using localStorage. This is essential for accurate marketing analytics and conversion tracking.

## Key Features

- 🔄 Automatically captures UTM parameters from URLs
- 💾 Persists UTM data across page transitions using localStorage
- 🔗 Adds UTM parameters to internal links
- ⚡ Zero external dependencies
- 🚀 Performance optimized

## Use Cases

- Track marketing campaign effectiveness
- Measure conversion paths
- Analyze user journey from specific sources
- Integrate with analytics tools

## Supported UTM Parameters

- utm_source
- utm_medium
- utm_campaign
- utm_term
- utm_content

## Installation

1. Upload the plugin files to the `/wp-content/plugins/utm-persistence` directory, or install the plugin through the WordPress plugins screen directly
2. Activate the plugin through the 'Plugins' screen in WordPress
3. That's it! No further configuration needed. The plugin will automatically append initial UTMs to all valid anchor tags

## Requirements

- WordPress 5.2 or higher
- PHP 7.2 or higher

## Privacy Policy

This plugin stores UTM parameters in the user's browser localStorage. This data remains on the user's device and is not sent to any external services.

The data is used for internal analytics and marketing attribution only.

## Changelog

### 1.0.0
- Initial release
- Basic UTM parameter tracking
- localStorage implementation

## Author

Developed by [koval24](https://profiles.wordpress.org/koval24/)

## License

This plugin is licensed under the GPL v2 or later. See the [LICENSE](https://www.gnu.org/licenses/gpl-2.0.html) file for details.
