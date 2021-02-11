<?php 
 $username  = $_GET['username'];
 $email  = $_GET['email'];
 $password = $_GET['password'];
 $role = $_GET['role'];

$data = [
    "username" => $username,
    "email" => $email,
    "password" => $password,
    "role" => $role
];

$json = json_encode($data);
print_r($json);



?>
