<?php

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../db.php';
require __DIR__ . '/../app/controllers/StudentController.php';

use Jenssegers\Blade\Blade;

$views=__DIR__ . '/../app/views';
$cache=__DIR__ . '/../cache/views';
$blade=new Blade($views,$cache);

$controller=new StudentController($pdo,$blade);

$page=$_GET['page'] ?? 'index';

switch($page){
	case 'create':
		$controller->create();
		break;
	case 'store':
		$controller->store();
		break;
	case 'edit':
		$controller->edit($_GET['id']);
		break;
	case 'update':
		$controller->update($_GET['id']);
		break;
	case 'delete':
		$controller->delete($_GET['id']);
		break;
	default:
		$controller->index();
}

?>