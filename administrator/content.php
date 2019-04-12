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
	require_once('tracking-aro.php');
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
	
	case 'list-customer':
	require_once('customerlist.php');
	break;
	
	case 'detail-customer':
	require_once('detail-customer.php');
	break;
	
	case 'detail-aro':
	require_once('detail-aro.php');
	break;
	
	case 'userlist':
	require_once('userlist.php');
	break;
	
	case 'edit-userlist':
	require_once('edit-userlist.php');
	break;
	
	case 'change-password':
	require_once('change-password.php');
	break;
	
	case 'profile':
	require_once('profile.php');
	break;
	
	case 'aro-priority':
	require_once('aro-priority.php');
	break;
	
	case 'aro-priority1':
	require_once('aro-priority1.php');
	break;
	
	case 'visit-result':
	require_once('visit-result.php');
	break;
	
	case 'result-detail':
	require_once('result-detail.php');
	break;
	
	case 'reasign-aro':
	require_once('reasign-aro.php');
	break;
	
	default:
	require_once('home.php');
}

?>