<?php

function user_select_by_name($pdo, $name)
{
	$stmt = $pdo->prepare('
        SELECT user_id, name, email, register_ip, ip, time, register_time,
               power, status, read_message_id, guild, server_id
        FROM users
        WHERE name = :name
        LIMIT 1
    ');
	$stmt->bindValue(':name', $name, PDO::PARAM_INT);
	$stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_OBJ);

    if (!$result) {
        throw new Exception('user not found');
    }

    return $result;
}