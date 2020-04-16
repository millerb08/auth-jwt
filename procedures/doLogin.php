<?php
require_once __DIR__."/../inc/bootstrap.php";

$username = request()->get("username");
$password = request()->get("password");
$user = findUserByUsername($username);
if(empty($user)){
  $session->getFlashBag()->add("error", "Username was not found");
  redirect("/login.php");
}


if(!password_verify($password, $user["password"])){
  $session->getFlashBag()->add("error", "Invalid password");
  redirect("/login.php");
}

$session->set("auth_logged_in", true);
$session->set("auth_user_id", (int) $user["id"]);
$session->set("auth_roles", (int) $user["role_id"]);
$session->getFlashBag()->add("success", "Successfully logged In");
redirect("/");