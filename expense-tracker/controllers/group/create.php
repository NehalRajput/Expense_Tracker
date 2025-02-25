<?php
$config = require base_path('config.php');
$db = new Core\Database($config['database']);
header('Content-Type: application/json'); // Set content type to JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $groupName = trim($_POST['group_name'] ?? '');

    if ($groupName) {
        // Check if the group name already exists
        $existingGroup = $db->query("SELECT id FROM groups WHERE group_name = :group_name", [
            'group_name' => $groupName
        ])->find();

        if ($existingGroup) {
            echo json_encode(['success' => false, 'message' => 'Group name already exists']);
            exit();
        }

        // Insert new group
        $db->query("INSERT INTO groups (group_name) VALUES (:group_name)", [
            'group_name' => $groupName
        ]);

        echo json_encode(['success' => true, 'message' => 'Group created successfully']);
        exit();
    } else {
        echo json_encode(['success' => false, 'message' => 'Group name is required']);
        exit();
    }
}

exit();
?>
