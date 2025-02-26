<?php

$config = require base_path('config.php');
$db = new Core\Database($config['database']);

if (isset($_GET['id'])) {
    $group = $db->query('SELECT * FROM groups WHERE id = :id', [
        'id' => $_GET['id']
    ])->findOrFail();
    
    view('group/edit.view.php', [
        'group' => $group
    ]);
} else {
    echo "Group ID not found!";
}
