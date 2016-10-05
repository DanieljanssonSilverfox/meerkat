<?php

$app->route(['GET'], '/404', function($request) {
  $props = array(
    'view' => '404',
    'title' => '404 - Ett fel uppstod',
    'pageNotFound' => $request->getUri()
  );
  
  return $request->template('index.phtml', $props);
});