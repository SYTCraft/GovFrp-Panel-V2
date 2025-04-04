<?php
namespace SYTCraftPanel;
use SYTCraftPanel;

$pages = new SYTCraftPanel\Pages();
$phdle = new SYTCraftPanel\PostHandler();

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$phdle->switcher($_GET);
	exit;
}

//Router
if(isset($_GET['page']) && preg_match("/^[A-Za-z0-9\-\_]{1,8}$/", $_GET['page'])) {
	$um = new SYTCraftPanel\UserManager();
	if($um->isLogged()) {
		if($_GET['page'] == "login" || $_GET['page'] == "register" || $_GET['page'] == "findpass") {
			exit("<script>location='?page=panel&module=home';</script>");
		}
		$pages->loadPage($_GET['page']);
	} else {
		if($_GET['page'] !== "login" && $_GET['page'] !== "register" && $_GET['page'] !== "findpass") {
			$pages->loadPage("login");
		} else {
			$pages->loadPage($_GET['page']);
		}
	}
} else {
	$pages->loadPage("home");
}
exit;
