<?php 

require_once($CFG->libdir . "/externallib.php");

class local_wpensar_external extends external_api {
    public static function wpensar_enrol_user_parameters() {
        return new external_function_parameters(
            array(
                'enrols' => return new external_multiple_structure(
                    new external_single_structure(
                        array(
                            'userid' => new external_value(PARAM_INT, 'userid'),
                            'courseid' => new external_value(PARAM_INT, 'course id'),
                            'roleid' => new external_value(PARAM_INT, 'role id'),
                        )
                    )
                )
            )
        );
    }

    public static function wpensar_enrol_user($enrols) {
        global $DB;

        $params = self::validate_parameters(self::wpensar_enrol_user_parameters(), array('enrols' => $enrols));
        $transaction = $DB->start_delegated_transaction();
        foreach ($params['enrols'] as $enrol) {
            $userid = $enrol['userid'];
            $courseid = $enrol['courseid'];
            $roleid = $enrol['roleid'];

            $context = $DB->get_record('context', array('instanceid' => $courseid, 'contextlevel' => 50));
            if (empty($context->id)) {
                throw new invalid_parameter_exception('Invalid context');
            }

            $enrol = $DB->get_record('context', array('enrol' => 'manual', 'courseid' => $courseid));
            if (empty($enrol->id)) {
                throw new invalid_parameter_exception('Invalid enrol');
            }

            $role_assignments = new stdClass();
            $role_assignments->roleid = $roleid;
            $role_assignments->contextid = $context->id;
            $role_assignments->userid = $userid;
            $DB->insert_record('role_assignments', $role_assignments);

            $user_enrolments = new stdClass();
            $user_enrolments->status = 0;
            $user_enrolments->enrolid = $enrol->id;
            $user_enrolments->userid = $userid;
            $user_enrolments->timestart = date('Y-m-d');
            $user_enrolments->timend = 0;
            $user_enrolments->timecreated = date('Y-m-d'); 
            $user_enrolments->timemodified = 0; 
            $DB->insert_record('user_enrolments', $user_enrolments);
        }
        $transaction->allow_commit();
        return null;
    }

    public static function wpensar_enrol_user_returns() {
        return null;
    }
}
