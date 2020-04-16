<?php 
function isAuthenticated(){
  global $session;
  return $session->get("auth_logged_in", false); // second parameter is the default value
}

function requireAuth(){
  if(!isAuthenticated()){
    global $session;
    $session->getFlashBag()-add("error","Not Authorized");
    redirect("/login.php");
  }
}

function saveUserSession($user){
  global $session;
  $session->set("auth_logged_in", true);
  $session->set("auth_user_id", (int) $user["id"]);
  $session->set("auth_roles", (int) $user["role_id"]);
  $session->getFlashBag()->add("success", "Successfully logged In");
}