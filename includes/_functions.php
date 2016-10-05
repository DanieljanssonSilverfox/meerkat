<?php

// CONSTANTS
//define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/meerkat.local');
define('ROOT_PATH', realpath(__DIR__ . '/..'));
define('TEMPLATES_PATH', ROOT_PATH . '/app/templates');
define('VIEWS_PATH', ROOT_PATH . '/app/views');


// FUNCTIONS
function preprint($var, $detailed = false) {
  echo '<pre>';
  if($detailed) print_r($var);
    else echo json_encode($var, JSON_PRETTY_PRINT);
  echo '</pre>';
}

function getUriString() {
  $uri_string = $_SERVER['REQUEST_URI'];
  $query_string = $_SERVER['QUERY_STRING'];

  // Check for GET query params
  if(isset($_GET)) $uri_string = str_replace('?' . $query_string, '', $uri_string);

  // Remove trailing (if any)
  if(strlen($uri_string) > 1 && substr($uri_string, -1) === '/') $uri_string = substr($uri_string, 0, -1);
  
  return $uri_string;
}

function getViewPaths() {
  $root = ROOT_PATH . '/app/views';
  
  $view_paths = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($root, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST,
    RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
  );
  
  $paths = array();
  foreach($view_paths as $path => $dir) {
    if($dir->isDir()) {
      $file = explode('/', $path);
      $file = $file[count($file)-1] . '.php';
      $file_path = $path . '/' . $file;
      $paths[] = $file_path;
    }
  }
  
  return $paths;
}