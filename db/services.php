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
        'type' => 'write'
    ),
    'local_wpensar_update_user' => array(
        'classname' => 'core_user_external',
        'methodname' => 'update_users',
        'classpath' => 'user/externallib.php',
        'description' => 'Atualiza',
        'type' => 'write'
    ),
);

$services = array(
    'WPensar Service' => array(
        'functions' => array_keys($functions),
        'restrictedusers' => 0,
        'enabled'=>1,
    )
);