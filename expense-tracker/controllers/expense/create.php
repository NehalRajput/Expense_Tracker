<?php
$config = require base_path('config.php');
$db = new Core\Database($config['database']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $expenseName = $_POST['expense_name'] ?? '';
    $amount = $_POST['amount'] ?? 0;
    $expenseDate = $_POST['expense_date'] ?? date('Y-m-d');
    $groupId = $_POST['group_id'] ?? null;

    if ($expenseName && $amount && $groupId) {
        $db->query("INSERT INTO expenses (expense_name, amount, expense_date, group_id) 
                    VALUES (:expense_name, :amount, :expense_date, :group_id)", [
            'expense_name' => $expenseName,
            'amount' => $amount,
            'expense_date' => $expenseDate,
            'group_id' => $groupId
        ]);

        header('Location: /expense');
        exit();
    }
}

$groups = $db->query("SELECT id, group_name FROM groups")->get();

view('expense/create.view.php', [
    'groups' => $groups,
    'errors' => []
]);
?>
