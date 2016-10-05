<?php

class App {
  
  private $container;
  private $routes = [];
  
  public function __construct($container = []) {
    if(is_array($container)) $this->container = (object) $container;
    
    $this->routes['GET'] = [];
    $this->routes['POST'] = [];
  }
  
  public function route($methods, $pattern, $callable) {
    $callable = $callable->bindTo($this->container);
    
    foreach($this->routes as $method => $routes) {
      if(in_array($method, $methods)) $this->routes[$method][$pattern] = $callable;
        else $this->routes[$method][$pattern] = null;
    }
  }
  
  public function template($template, $args) {
    extract($args);
    unset($args);
    
    require(ROOT_PATH . '/app/templates/' . $template);
  }
  
  public function redirect($url, $statusCode = 303) {
    header('Location: ' . $url, true, $statusCode);
    exit();
  }
  
  public function getContainer() {
    return $this->container;
  }
  
  public function run() {
    $uri_string = getUriString();
    $method = $_SERVER['REQUEST_METHOD'];
    $routes = $this->routes[$method];
    
    // Evaluate each dependency
    foreach($this->container as $key => $value) $this->container->{$key} = $value($this->container);
    
    // Render current route
    if(!array_key_exists($uri_string, $routes)) {
      $this->routes['GET']['/404']($this);
      die();
    } else {
      if($routes[$uri_string] !== null) {
        echo $routes[$uri_string]($this);
      } else {
        die('Method not allowed: ' . $method);
      }
    }
  }
  
  public function getUri() {
    return getUriString();
  }
  
  public function getParams() {
    if(!empty($_GET)) return $_GET;
      else if(!empty($_POST)) return $_POST;
      else return false;
  }
  
  public function getParam($param) {
    if(!empty($_GET)) return $_GET[$param];
      else if(!empty($_POST)) return $_POST[$param];
      else return false;
  }
  
  public function isGet() {
    if($_SERVER['REQUEST_METHOD'] === 'GET') return true;
      else return false;
  }
  
  public function isPost() {
    if($_SERVER['REQUEST_METHOD'] === 'POST') return true;
      else return false;
  }
  
  public function json($json) {
    header('Content-Type: application/json');
    return json_encode($json);
  }
}