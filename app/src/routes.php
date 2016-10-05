<?php

// Require all views from /views directory
foreach(getViewPaths() as $path) require($path);


/* ADDITIONAL ROUTES
=============================== */

// Example route:
$app->route(['GET'], '/hello-world', function($request) {
  $props = array(
    'title' => 'Hello World!',
    'viewContent' => '<h1>Hello World</h1>'
  );
  
  return $request->template('index.phtml', $props);
});