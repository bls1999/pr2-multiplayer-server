<?php

if (!defined(ROOT_DIR)) {
    require_once __DIR__ . '/../../config.php'; // env
}

require_once FNS_DIR . '/common_fns.php';
require_once QUERIES_DIR . '/servers.php';
require_once COMMON_DIR . '/manage_socket/socket_manage_fns.php';

$date = date('r');
output("Restarting all servers on $date...");

// connect to db
$pdo = pdo_connect();

// initiate restart
restart_servers($pdo);

// tell it to the world
output('All operations completed.');
