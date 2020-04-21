<?php
function isAuthenticated()
{
  return decodeAuthCookie();
}

function requireAuth()
{
  if (!isAuthenticated()) {
    global $session;
    $session->getFlashBag()->add('error', 'Not Authorized');
    redirect('/login.php');
  }
}

function isAdmin(){
  if(!isAuthenticated()){
    return false;
  }
  return decodeAuthCookie('auth_roles') === 1;
}

function requireAdmin(){
  if(!isAdmin()){
    global $session;
    $session->getFlashBag()->add("error","Not Authorized");
    redirect("/login.php");
  }
}

function isOwner($ownerId){
  if(!isAuthenticated()){
    return false;
  }
  return $ownerId == decodeAuthCookie('auth_user_id');
}

function getAuthenticatedUser(){
  return findUserById(decodeAuthCookie('auth_user_id'));
}

function saveUserData($user)
{
  global $session;
  $session->getFlashBag()->add('success', 'Successfully Logged In');
  $expTime = time() + 3600; //3600 secods 1 hour
  $jwt = Firebase\JWT\JWT::encode(
     [
        "iss" => request()->getBaseUrl(), //issuer
        "sub" => (int) $user['id'], //subject
        "exp" => $expTime, //expiration time
        "iat" => time(), //issued at (the when was emited)
        "nbf" => time(), //not before (when the token is not accepted)
        "auth_roles" => (int) $user['role_id']
    ],
    getenv("SECRET_KEY"),
    "HS256"
  );  
  $cookie = setAuthCookie($jwt,$expTime);
  redirect("/", ["cookies" => [$cookie]]);
}

function setAuthCookie($data, $expTime){
  $cookie = new Symfony\Component\HttpFoundation\Cookie(
    "auth", //name
    $data, //value
    $expTime, //expiration time
    "/",//the path for the cookie to be avaliable
    ".treehouse-app.com",//Domain
    false, //httpS
    true //httpOnly
  );
  return $cookie;
}

function decodeAuthCookie($prop = NULL){
  try{
    Firebase\JWT\JWT::$leeway=1;
    $cookie = Firebase\JWT\JWT::decode(
      request()->cookies->get("auth"), //cookie o JWT to decode
      getenv("SECRET_KEY"), //SECRET KEY to encode
      ["HS256"] //crypto sistem method to encode and decode
    );
  }catch(Exception $e){
    return false;
  }
  if($prop === NULL){
    return $cookie;
  }
  if($prop == "auth_user_id"){
    $pro = "sub";
  }
  if(!isset($cookie->$prop)){
    return false;
  }
  return $cookie->$prop;
}