<?php
$current_page = 'home';

if(array_key_exists('page',$_GET)) {
    $current_page = $_GET['page'];
}

switch ($current_page) {
	
	case 'home':
	require_once('home.php');
	break;
	
	case 'collector-assignment':
	require_once('collector-assignment.php');
	break;
	
	case 'tasklist':
	require_once('tasklist.php');
	break;
	
	case 'tracking-collector':
	require_once('tracking-collector.php');
	break;
	
	case 'tracking-collector-location':
	require_once('tracking-collector-location.php');
	break;
	
	case 'dashboard':
	require_once('dashboard.php');
	break;
	
	case 'history':
	require_once('history.php');
	break;
	
	case 'list-aro':
	require_once('arolist.php');
	break;
	
	case 'userlist':
	require_once('userlist.php');
	break;
	
	case 'edit-userlist':
	require_once('edit-userlist.php');
	break;
	
	default:
	require_once('home.php');
}

?>