<?php 

require_once($CFG->libdir . "/externallib.php");

class local_wpensar_external extends external_api {
    public static function local_wpensar_insert_context_parameters() {
        return new external_function_parameters(
            array(
                'context' => new external_single_structure(
                    array(
                        'contextlevel' => new external_value(PARAM_INT, 'contextlevel'),
                        'instanceid' => new external_value(PARAM_INT, 'instanceid'),
                    )
                )
            )
        );
    }

    public static function local_wpensar_insert_context($context) {
        global $DB;

        $params = self::validate_parameters(self::local_wpensar_insert_context_parameters(), array('context' => $context));
        $context = new stdClass();
        $context->contextlevel = $params['contextlevel'];
        $context->instanceid = $params['instanceid'];
        $context->id = $DB->insert_record('context', $context);
        $context->path = '/1/3/' . $context->id;
        $context->depth = 3;
        $DB->update_record('context', $context);
        return $context->id;
    }

    public static function local_wpensar_insert_context_returns() {
        return new external_value(PARAM_INT, 'id');
    }

    public static function local_wpensar_insert_enrol_parameters() {
        return new external_function_parameters(
            array(
                'enrol' => new external_single_structure(
                    array(
                        'enrol' => new external_value(PARAM_TEXT, 'ENROL'),
                        'status' => new external_value(PARAM_INT, 'status'),
                        'courseid' => new external_value(PARAM_INT, 'courseid'),
                    )
                )
            )
        );
    }

    public static function local_wpensar_enrol($enrol) {
        global $DB;

        $params = self::validate_parameters(self::local_wpensar_insert_enrol_parameters(), array('enrol' => $enrol));
        $enrol = new stdClass();
        $enrol->enrol = $params['enrol'];
        $enrol->status = $params['status'];
        $enrol->courseid = $params['courseid'];

        $id = $DB->insert_record('enrol', $enrol);
        return $id;
    }

    public static function local_wpensar_insert_enrol_returns() {
        return new external_value(PARAM_INT, 'id');
    }

    #(`status`, `enrolid`, `userid`, `timestart`, `timeend`, `timecreated`, `timemodified`) 
    public static function local_wpensar_insert_user_enrolments_parameters() {
        return new external_function_parameters(
            array(
                'roles' => new external_single_structure(
                    array(
                        'enrolid' => new external_value(PARAM_TEXT, 'enrolid'),
                        'userid' => new external_value(PARAM_INT, 'userid'),
                    )
                )
            )
        );
    }

    public static function local_wpensar_user_enrolments($roles) {
        global $DB;

        $params = self::validate_parameters(self::local_wpensar_insert_user_enrolments_parameters(), array('roles' => $roles));
        $user_enrolments = new stdClass();
        $user_enrolments->enrolid = $params['enrolid'];
        $user_enrolments->userid = $params['userid'];
        $user_enrolments->status = 0;
        $user_enrolments->timestart = date('Y-m-d');
        $user_enrolments->timeend = 0;
        $user_enrolments->timecreated = date('Y-m-d');
        $user_enrolments->timemodified = 0;
        $id = $DB->insert_record('user_enrolments', $user_enrolments);
        return $id;
    }

    public static function local_wpensar_insert_user_enrolments_returns() {
        return new external_value(PARAM_INT, 'id');
    }
    public static function wpensar_enrol_user_parameters() {
        return new external_function_parameters(
            array(
                'enrols' => new external_multiple_structure(
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
