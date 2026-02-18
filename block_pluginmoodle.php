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

class block_pluginmoodle extends block_base {

    /**
     * Initialise the block.
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_pluginmoodle');
    }

    /**
     * Return the block content.
     *
     * @return stdClass The block content.
     */
    public function get_content() {
        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->footer = '';

        // Load the JavaScript for the popup.
        $this->page->requires->js_call_amd('block_pluginmoodle/popup', 'init');

        // Render the button.
        $this->content->text = html_writer::tag(
            'button',
            get_string('clickme', 'block_pluginmoodle'),
            [
                'id'    => 'block-pluginmoodle-btn',
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
    public function applicable_formats() {
        return ['all' => true];
    }
}
