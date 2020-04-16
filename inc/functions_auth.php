<?php 
function isAuthenticated(){
  global $session;
  return $session->get("auth_logged_in", false); // second parameter is the default value
}