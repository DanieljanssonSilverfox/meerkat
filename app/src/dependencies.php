<?php

$container = $app->getContainer();

// DATABASE HANDLER
//$container->db = function($c) {
//  preprint($c);
//  
//  $host = $c->dbconn['host'];
//  $dbname = $c->dbconn['meerkat'];
//  $username = $c->dbconn['root'];
//  $password = $c->dbconn['root'];
//  
//  $pdo = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $username, $password);
//  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//  $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
//  return $pdo;
//};

// SESSION HANDLER
$container->session = function($c) {
  return new Session;
};

// GET DOMAIN URL
$container->domainUrl = function($c) {
  return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on" ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'];
};

// GET CURRENT TIMESTAMP
$container->timestamp = function($c) {
  return date('Y-m-d H:i:s', time());
};