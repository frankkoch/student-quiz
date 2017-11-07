php admin/cli/backup.php --courseid=2 --destination=/moodle/backup/

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
 * Define all the backup steps that will be used by the backup_studentquiz_activity_structure_step
 *
 * @package   mod_studentquiz
 * @category  backup
 * @copyright 2017 HSR (http://www.hsr.ch)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Define the complete StudentQuiz structure for backup, with file and id annotations
 *
 * @package   mod_studentquiz
 * @category  backup
 * @copyright 2017 HSR (http://www.hsr.ch)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class backup_studentquiz_activity_structure_step extends backup_activity_structure_step {

    /**
     * Defines the backup structure of the module
     *
     * @return backup_nested_element
     */
    protected function define_structure() {

        // Define the root element describing the StudentQuiz instance.
        $studentquiz = new backup_nested_element('studentquiz', array('id'), array(
            'coursemodule', 'name', 'hiddensection', 'intro', 'introformat', 'grade', 'anonymrank', 'quizpracticebehaviour'));

        // studentquiz_progress.
        $progresses = new backup_nested_element('progresses');
        $progress = new backup_nested_element('progress', array('questionid', 'userid', 'studentquizid'),
            array('lastanswercorrect', 'attempts', 'correctattempts'));

       // TODO: studentquiz_approved

        $studentquiz->add_child($progresses);
       $progresses->add_child($progress);

        // Define data sources.
        $studentquiz->set_source_table('studentquiz', array('id' => backup::VAR_ACTIVITYID));

       // Note: Progress contains user data
        // TODO: Check of user info requested or not
        if (true) {
            $progress->set_source_table( 'studentquiz_progress',
                array('studentquizid' => backup::VAR_PARENTID));
        }

        // Define id annotations.
        $progress->annotate_ids('user', 'userid');
        $progress->annotate_ids('question', 'questionid');

        // Define file annotations (we do not use itemid in this example).
        $studentquiz->annotate_files('mod_studentquiz', 'intro', null);

        // Return the root element (studentquiz), wrapped into standard activity structure.
        return $this->prepare_activity_structure($studentquiz);
    }
}
