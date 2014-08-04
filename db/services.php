<?php

$functions = array(
    'local_wpensar_insert_user' => array(
        'classname' => 'core_user_external',
        'methodname' => 'create_users',
        'classpath' => 'user/externallib.php',
        'description' => 'Insere um usuário no moodle',
        'type' => 'write'
    ),
    'local_wpensar_get_user' => array(
        'classname' => 'core_user_external',
        'methodname' => 'get_users_by_field',
        'classpath' => 'user/externallib.php',
        'description' => 'pega usuarios',
        'type' => 'read'
    ),
    'local_wpensar_update_user' => array(
        'classname' => 'core_user_external',
        'methodname' => 'update_users',
        'classpath' => 'user/externallib.php',
        'description' => 'Atualiza',
        'type' => 'write'
    ),
    'local_wpensar_insert_course' => array(
        'classname' => 'core_course_external',
        'methodname' => 'create_courses',
        'classpath' => 'course/externallib.php',
        'description' => 'Insere um curso',
        'type' => 'write'
    ),
    'local_wpensar_assign_roles' => array(
        'classname' => 'core_role_external',
        'methodname' => 'assign_roles',
        'classpath' => 'enrol/externallib.php',
        'description' => 'Atribui um papel a um usuário',
        'type' => 'write'
    ),


    /*

    'local_wpensar_insert_context' => array(
        'classname' => 'local_wpensar_external',
        'methodname' => 'wpensar_insert_context',
        'classpath' => 'local/wpensar_plugin_moodle/externallib.php',
        'description' => 'Inserir context',
        'type' => 'write'
    ),
    'local_wpensar_insert_enrol' => array(
        'classname' => 'local_wpensar_external',
        'methodname' => 'wpensar_insert_enrol',
        'classpath' => 'local/wpensar_plugin_moodle/externallib.php',
        'description' => 'Inserir context',
        'type' => 'write'
    ),
    'local_wpensar_insert_user_enrolments' => array(
        'classname' => 'local_wpensar_external',
        'methodname' => 'wpensar_insert_user_enrolments',
        'classpath' => 'local/wpensar_plugin_moodle/externallib.php',
        'description' => 'Inserir user_enrolments',
        'type' => 'write'
    )
    'local_wpensar_enrol_user' => array(
        'classname' => 'local_wpensar_external',
        'methodname' => 'wpensar_enrol_user',
        'classpath' => 'local/wpensar_plugin_moodle/externallib.php',
        'description' => 'Enrol user',
        'type' => 'write'
    ),*/
);

$services = array(
    'WPensar Service' => array(
        'functions' => array_keys($functions),
        'restrictedusers' => 0,
        'enabled'=>1,
    )
);