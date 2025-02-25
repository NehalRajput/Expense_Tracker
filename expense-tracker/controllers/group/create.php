<?php

use core\Validator;

require base_path('core/Validator.php');

$config = require base_path('config.php');
$db = new Core\Database($config['database']);

$groupName = $_POST['groupName'] ?? null;
$expenseName = $_POST['expense_name'] ?? null;
$amount = $_POST['amount'] ?? null;
$date = $_POST['date'] ?? null;
$groupId = $_POST['group_id'] ?? null;

$errors = [];

// Validate group name
if (!Validator::string($groupName, 4, 10)) {
    $errors['groupName'] = 'Group name is required and must be between 4 and 10 characters';
}

// Validate expense fields
if (!$expenseName || !$amount || !$date || !$groupId) {
    $errors['expense'] = 'All expense fields are required';
}

// Check for duplicate group
$group = $db->query('SELECT * FROM groups WHERE group_name = :name', [
    'name' => $groupName
])->find();

if ($group) {
    $errors['groupName'] = 'Group name already exists';
}

if (!empty($errors)) {
    view('group/index.view.php', [
        'errors' => $errors
    ]);
    exit();
}

// Insert new group if not exists
if (!$group) {
    $db->query('INSERT INTO groups (group_name) VALUES (:name)', [
        'name' => $groupName
    ]);
    
    // Get the new group ID
    $groupId = $db->connection->lastInsertId();
}

// Insert expense
$db->query('INSERT INTO expenses (expense_name, amount, date, group_id) VALUES (:expense_name, :amount, :date, :group_id)', [
    'expense_name' => $expenseName,
    'amount' => $amount,
    'date' => $date,
    'group_id' => $groupId,
]);

header('Location: /');
exit();