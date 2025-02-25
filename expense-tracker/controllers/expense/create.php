<?php

$config = require base_path('config.php');
$db = new Core\Database($config['database']);

// Validate inputs
$expenseName = $_POST['expense_name'] ?? null;
$amount = $_POST['amount'] ?? null;
$groupId = $_POST['group_id'] ?? null;
$expenseDate = $_POST['expense_date'] ?? null;

if (!$expenseName || !$amount || !$groupId || !$expenseDate) {
    die('All fields are required. Please check your input.');
}

// Fetch Group Name (Category) to ensure the group exists
$category = $db->query('SELECT group_name FROM groups WHERE id = :id', [
    'id' => $groupId
])->findOrFail();

// Insert the expense into the database
$db->query('INSERT INTO expenses (expense_name, amount, group_id, expense_date) 
            VALUES (:expense_name, :amount, :group_id, :expense_date)', [
    'expense_name' => $expenseName,
    'amount' => $amount,
    'group_id' => $groupId,
    'expense_date' => $expenseDate
]);

// Redirect to Home
header('Location: /');
exit();
?>