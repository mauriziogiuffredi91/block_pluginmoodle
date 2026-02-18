<?php
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
 * Main block class for block_pluginmoodle.
 *
 * @package   block_pluginmoodle
 * @copyright 2026 Maurizio Giuffredi
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class block_pluginmoodle extends block_base
{

    /**
     * Initialise the block.
     */
    public function init()
    {
        $this->title = get_string('pluginname', 'block_pluginmoodle');
    }

    /**
     * Return the block content.
     *
     * @return stdClass The block content.
     */
    public function get_content()
    {
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->footer = '';

        $welcomemsg = get_string('welcomemsg', 'block_pluginmoodle');

        // Inline JavaScript for the popup (no AMD compilation needed).
        $js = "
        (function() {
            function initPopupBtn() {
                var btn = document.getElementById('block-pluginmoodle-btn');
                if (!btn) return;
                btn.addEventListener('click', function() {
                    var overlay = document.createElement('div');
                    overlay.style.cssText = 'position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);display:flex;align-items:center;justify-content:center;z-index:9999;cursor:pointer';
                    var box = document.createElement('div');
                    box.style.cssText = 'background:#fff;padding:40px 50px;border-radius:12px;box-shadow:0 8px 32px rgba(0,0,0,0.3);text-align:center;font-size:1.3rem;font-weight:bold;color:#333;cursor:default;max-width:400px';
                    box.textContent = " . json_encode($welcomemsg) . ";
                    overlay.appendChild(box);
                    document.body.appendChild(overlay);
                    overlay.addEventListener('click', function(e) {
                        if (e.target === overlay) document.body.removeChild(overlay);
                    });
                });
            }
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initPopupBtn);
            } else {
                initPopupBtn();
            }
        })();
        ";
        $this->page->requires->js_init_code($js);

        // Render the button.
        $this->content->text = html_writer::tag(
            'button',
            get_string('clickme', 'block_pluginmoodle'),
        [
            'id' => 'block-pluginmoodle-btn',
            'class' => 'btn btn-primary',
        ]
        );

        return $this->content;
    }

    /**
     * Allow the block to be added to any page.
     *
     * @return array
     */
    public function applicable_formats()
    {
        return ['all' => true];
    }
}
