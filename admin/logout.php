<?php
session_start();
if (isset($_SESSION['admin_username'])) {
	unset($_SESSION['admin_username']);
}
if (isset($_SESSION['admin_id'])) {
	unset($_SESSION['admin_id']);
}
if (isset($_SESSION['supp_id'])) {
	unset($_SESSION['supp_id']);
}
if (isset($_SESSION['super_id'])) {
	unset($_SESSION['super_id']);
}
header("location:index");
session_destroy();
