<?php

$config = require base_path('config.php');
$db = new Core\Database($config['database']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['_method'] === 'PATCH') {
    $id = $_POST['id'];
    $group_name = trim($_POST['group_name']);

    if (!empty($group_name)) {
        $result = $db->query('UPDATE groups SET group_name = :group_name WHERE id = :id', [
            'group_name' => $group_name,
            'id' => $id
        ]);

        if ($result) {
            echo json_encode([
                'success' => true,
                'message' => 'Group updated successfully!'
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Failed to update group. Please try again.'
            ]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Group name cannot be empty']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

?>


