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
            (function() {
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
                        try {
                            localStorage.setItem(UTM_STORAGE_KEY, JSON.stringify(utmData));
                        } catch (e) {}
                    }
                }

                // localStorage can throw (private mode, blocked storage) or hold bad JSON
                function getStoredUTMs() {
                    try {
                        return JSON.parse(localStorage.getItem(UTM_STORAGE_KEY));
                    } catch (e) {
                        return null;
                    }
                }

                // Add stored UTMs to a link, unless it already has its own
                function decorateLink(link) {
                    const utmParams = getStoredUTMs();
                    if (!utmParams) return;

                    const href = link.getAttribute('href');
                    // Skip empty and same-page anchors (#top), they would cause a reload
                    if (!href || href.startsWith('#')) return;

                    let url;
                    try {
                        url = new URL(href, window.location.href);
                    } catch (e) {
                        return;
                    }

                    // Skip mailto:, tel:, javascript: etc.
                    if (url.protocol !== 'http:' && url.protocol !== 'https:') return;

                    if (UTM_PARAMS.some(param => url.searchParams.has(param))) return;

                    Object.entries(utmParams).forEach(([key, value]) => {
                        url.searchParams.set(key, value);
                    });

                    link.setAttribute('href', url.toString());
                }

                function modifyLinks() {
                    document.querySelectorAll('a[href]').forEach(decorateLink);
                }

                // Links added after load (menus, popups, AJAX) get decorated when clicked
                function onLinkClick(e) {
                    const link = e.target.closest && e.target.closest('a[href]');
                    if (link) decorateLink(link);
                }

                captureUTMParameters();
                document.addEventListener('click', onLinkClick, true);
                document.addEventListener('auxclick', onLinkClick, true);

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', modifyLinks);
                } else {
                    modifyLinks();
                }
            })();
        </script>
<?php
    }
}

// Initialize the plugin
new UTMParameterPersistence();
