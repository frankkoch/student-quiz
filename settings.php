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
 * The mod_studentquiz settings.
 *
 * @package    mod_studentquiz
 * @copyright  2017 HSR (http://www.hsr.ch)
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

if ($ADMIN->fulltree) {
    $settings->add(new admin_setting_heading(
        'studentquiz/ratingsettings',
        get_string('rankingsettingsheader', 'studentquiz'),
        get_string('rankingsettingsdescription', 'studentquiz')
    ));

    $settings->add(new admin_setting_configtext(
        'studentquiz_add_question_quantifier',
        get_string('settings_add_q_quantifier', 'studentquiz'),
        get_string('config_add_q_quantifier', 'studentquiz'),
        10, PARAM_INT
    ));

    $settings->add(new admin_setting_configtext(
        'studentquiz_approved_quantifier',
        get_string('settings_approved_quantifier', 'studentquiz'),
        get_string('config_approved_quantifier', 'studentquiz'),
        5, PARAM_INT
    ));

    $settings->add(new admin_setting_configtext(
        'studentquiz_vote_quantifier',
        get_string('settings_vote_quantifier', 'studentquiz'),
        get_string('config_vote_quantifier', 'studentquiz'),
        3, PARAM_INT
    ));

    $settings->add(new admin_setting_configtext(
        'studentquiz_correct_answered_question_quantifier',
        get_string('settings_correct_answered_q_quantifier', 'studentquiz'),
        get_string('config_correct_answered_q_quantifier', 'studentquiz'),
        2, PARAM_INT
    ));

    $settings->add(new admin_setting_configtext(
        'studentquiz_incorrect_answered_question_quantifier',
        get_string('settings_incorrect_answered_q_quantifier', 'studentquiz'),
        get_string('config_incorrect_answered_q_quantifier', 'studentquiz'),
        0, PARAM_INT
    ));

    $settings->add(new admin_setting_heading(
        'studentquiz/importsettings',
        get_string('importsettingsheader', 'studentquiz'),
        get_string('importsettingsdescription', 'studentquiz')
    ));

    // Option to refuse the import functions to automatically remove empty sections. This option is required for
    // the removal of section 999. But since this plugin is actively trying to remove stuff it's primarly not
    // responsible for, thus can lead to side-effects, we need to give the admin the option to opt out from it.
    $settings->add(new admin_setting_configcheckbox('studentquiz/removeemptysections',
        get_string('settings/removeemptysections', 'studentquiz'),
        get_string('config/removeemptysections', 'studentquiz'),
        '1'
    ));
}
