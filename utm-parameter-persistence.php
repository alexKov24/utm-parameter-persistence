<?php
/*
Plugin Name: UTM Parameter Persistence
Plugin URI: https://github.com/alexKov24/utm-parameter-persistence
Description: Track and maintain UTM parameters across your WordPress site. Automatically captures UTM parameters from incoming traffic and persists them across page transitions using localStorage. Perfect for marketing analytics and conversion tracking.
Version: 1.0.0
Requires at least: 5.2
Tested up to: 6.7
Requires PHP: 7.2
Author: Alex Kovalev
Author URI: https://github.com/alexKov24
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: utm-parameter-persistence
*/

if (!defined('ABSPATH')) {
    exit;
}

class UTMParameterPersistence
{
    public function __construct()
    {
        add_action('wp_footer', array($this, 'inject_utm_script'));
    }

    public function inject_utm_script()
    {
?>
        <script>
            const UTM_STORAGE_KEY = 'stored_utm_params';
            const UTM_PARAMS = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content'];

            // Capture UTM parameters from URL
            function captureUTMParameters() {
                const urlParams = new URLSearchParams(window.location.search);
                const utmData = {};
                let hasUtm = false;

                UTM_PARAMS.forEach(param => {
                    if (urlParams.has(param)) {
                        utmData[param] = urlParams.get(param);
                        hasUtm = true;
                    }
                });

                if (hasUtm) {
                    localStorage.setItem(UTM_STORAGE_KEY, JSON.stringify(utmData));
                }
            }

            // Add UTMs to URL
            function addUTMsToUrl(url) {
                const storedUtms = localStorage.getItem(UTM_STORAGE_KEY);
                if (!storedUtms) return url;

                const utmParams = JSON.parse(storedUtms);
                const urlObj = new URL(url, window.location.origin);

                // Don't modify if URL already has UTM parameters
                const hasExistingUTMs = UTM_PARAMS.some(param => urlObj.searchParams.has(param));
                if (hasExistingUTMs) return url;

                // Add stored UTM parameters
                Object.entries(utmParams).forEach(([key, value]) => {
                    urlObj.searchParams.append(key, value);
                });

                return urlObj.toString();
            }

            function modifyLinks() {
                document.querySelectorAll('a').forEach(link => {
                    const href = link.getAttribute('href');
                    if (!href) return;

                    try {
                        const url = new URL(href, window.location.origin);
                        link.setAttribute('href', addUTMsToUrl(url.toString()));

                    } catch (e) {
                        console.error('Error processing URL:', href, e);
                    }
                });
            }

            // Initialize on page load
            document.addEventListener('DOMContentLoaded', () => {
                captureUTMParameters();
                modifyLinks();
            });
        </script>
<?php
    }
}

// Initialize the plugin
new UTMParameterPersistence();
