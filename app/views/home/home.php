<?php

$app->route(['GET'], '/', function($request) {
  $props = array(
    'view' => 'home',
    'title' => 'Home'
  );
  
  return $request->template('index.phtml', $props);
});