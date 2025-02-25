<?php
$config = require base_path('config.php');
$db = new Core\Database($config['database']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $groupName = $_POST['group_name'] ?? '';

    if ($groupName) {
        $db->query("INSERT INTO groups (group_name) VALUES (:group_name)", [
            'group_name' => $groupName
        ]);

        header('Location: /groups');
        exit();
    }
}

view('group/create.view.php', [
    'errors' => []
]);
?>
