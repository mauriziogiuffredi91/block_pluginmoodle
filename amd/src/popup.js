// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * AMD JavaScript module for block_pluginmoodle popup functionality.
 *
 * @module    block_pluginmoodle/popup
 * @copyright 2026 Maurizio Giuffredi
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define(['core/str'], function(Str) {

    /**
     * Create and show the popup overlay.
     */
    function showPopup() {
        // Create overlay
        var overlay = document.createElement('div');
        overlay.id = 'pluginmoodle-overlay';
        overlay.style.cssText = [
            'position: fixed',
            'top: 0',
            'left: 0',
            'width: 100%',
            'height: 100%',
            'background: rgba(0,0,0,0.5)',
            'display: flex',
            'align-items: center',
            'justify-content: center',
            'z-index: 9999',
            'cursor: pointer'
        ].join(';');

        // Create popup box
        var popup = document.createElement('div');
        popup.style.cssText = [
            'background: #fff',
            'padding: 40px 50px',
            'border-radius: 12px',
            'box-shadow: 0 8px 32px rgba(0,0,0,0.3)',
            'text-align: center',
            'font-size: 1.3rem',
            'font-weight: bold',
            'color: #333',
            'cursor: default',
            'max-width: 400px'
        ].join(';');

        // Load the string from Moodle language strings
        Str.get_string('welcomemsg', 'block_pluginmoodle').then(function(welcomeMsg) {
            popup.textContent = welcomeMsg;
        }).catch(function() {
            popup.textContent = 'Benvenuto nel mio primo Plugin';
        });

        overlay.appendChild(popup);
        document.body.appendChild(overlay);

        // Close when clicking outside the popup box
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                document.body.removeChild(overlay);
            }
        });
    }

    return {
        /**
         * Initialise the module: attach click handler to the button.
         */
        init: function() {
            document.addEventListener('DOMContentLoaded', function() {
                attachHandler();
            });
            // Also try immediately in case DOM is already ready
            attachHandler();

            function attachHandler() {
                var btn = document.getElementById('block-pluginmoodle-btn');
                if (btn && !btn.dataset.pluginmoodleInit) {
                    btn.dataset.pluginmoodleInit = '1';
                    btn.addEventListener('click', function() {
                        showPopup();
                    });
                }
            }
        }
    };
});
