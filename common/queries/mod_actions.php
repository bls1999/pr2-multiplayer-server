<?php


function mod_action_insert($pdo, $mod_id, $message, $type, $ip)
{
    $stmt = $pdo->prepare('
        INSERT INTO mod_actions
           SET time = :time,
               mod_id = :mod_id,
               message = :message,
               type = :type,
               ip = :ip
    ');
    $stmt->bindValue(':time', time(), PDO::PARAM_INT);
    $stmt->bindValue(':mod_id', $mod_id, PDO::PARAM_INT);
    $stmt->bindValue(':message', $message, PDO::PARAM_STR);
    $stmt->bindValue(':type', $type, PDO::PARAM_STR);
    $stmt->bindValue(':ip', $ip, PDO::PARAM_STR);
    $result = $stmt->execute();

    if ($result === false) {
        throw new Exception('Could not record moderator action.');
    }

    return $result;
}


function mod_actions_select($pdo, $in_start, $in_count)
{
    $start = max((int) $in_start, 0);
    $count = min(max((int) $in_count, 0), 100);

    $stmt = $pdo->prepare('
          SELECT *
            FROM mod_actions
           ORDER BY time DESC
           LIMIT :start, :count
    ');
    $stmt->bindValue(':start', $start, PDO::PARAM_INT);
    $stmt->bindValue(':count', $count, PDO::PARAM_INT);
    $result = $stmt->execute();

    if ($result === false) {
        throw new Exception('Could not retrieve the moderator action log.');
    }

    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
