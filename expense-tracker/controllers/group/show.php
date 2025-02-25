<?php

$config = require base_path('config.php');
$db = new Core\Database($config['database']);
$expenses = $db->query("SELECT id, expense_name, amount, DATE_FORMAT(expense_date, '%d-%m-%Y') AS formatted_date FROM expenses WHERE group_id = :id", [
    'id' => $_GET['id']
])->get();


view('group/show.view.php', [
    'expenses' => $expenses
]);
