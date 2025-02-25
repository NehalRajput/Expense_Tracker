<?php

$router->get('/', 'controllers/index.php');

// Group routes
$router->get('/groups', 'controllers/group/index.php');
$router->get('/group', 'controllers/group/show.php');
$router->get('/group/edit', 'controllers/group/edit.php');
$router->post('/group/create', 'controllers/group/create.php');
$router->patch('/groups', 'controllers/group/update.php');
$router->delete('/group', 'controllers/group/destroy.php');

// Expense routes
$router->get('/expense', 'controllers/expense/index.php');
$router->get('/expense/edit', 'controllers/expense/edit.php');
$router->post('/expense', 'controllers/expense/create.php');
$router->patch('/expenses', 'controllers/expense/update.php');
$router->delete('/expense', 'controllers/expense/destroy.php');

