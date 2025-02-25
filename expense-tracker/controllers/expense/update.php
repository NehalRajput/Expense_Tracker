<?php
$config = require base_path('config.php');
$db = new Core\Database($config['database']);

// Update expense details
$db->query("UPDATE expenses 
            SET expense_name = :expense_name, 
                amount = :amount,  
                group_id = :group_id, 
                expense_date = :expense_date 
            WHERE id = :id", [
    'expense_name' => $_POST['expense_name'],
    'amount'       => $_POST['amount'],
    'group_id'     => $_POST['group_id'],
    'expense_date' => $_POST['expense_date'],
    'id'           => $_POST['id']
]);

// Redirect after update
header('Location: /');
exit();
