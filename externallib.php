<?php 

require_once($CFG->libdir . "/externallib.php");

class local_wpensar_external extends external_api {
    /*public static function wpensar_insert_user_parameters() {
        return new external_function_parameters(
            array(
                'user' => new external_single_structure(
                    array(
                        'firstname' => new external_value(PARAM_TEXT, 'First name'),
                        'lastname' => new external_value(PARAM_TEXT, 'Last name'),
                        'email' => new external_value(PARAM_TEXT, 'Email'),
                        'username' => new external_value(PARAM_TEXT, 'Username'),
                        'password' => new external_value(PARAM_TEXT, 'Password'),
                        'confirmed' => new external_value(PARAM_INT, 'Confirmed'),
                        'mnethostid' => new external_value(PARAM_INT, 'x'),
                        'lang' => new external_value(PARAM_TEXT, 'Language')
                    )
                )
            )
        );
    }

    public static function wpensar_insert_user($user) {
        global $DB;
        $params = self::validate_parameters(self::wpensar_insert_user_parameters(),
                array('user' => $user));
    }

    public static function wpensar_insert_user_returns() {
        return new external_value(PARAM_INT, 'The moodle user id');
    }*/
}
