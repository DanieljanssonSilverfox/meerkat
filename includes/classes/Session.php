<?php

class Session {
  public function __construct() {
    if(!array_key_exists('APP', $_SESSION)) $_SESSION['APP'] = array();
    $this->updateActivity();
  }
  
  public function get($key, $default = null) {
    $this->updateActivity();
    return $_SESSION['APP'][$key] ?: $default;
  }
  
  public function set($key, $value) {
    $_SESSION['APP'][$key] = $value;
    $this->updateActivity();
    return $_SESSION[$var];
  }
  
  public function delete($key) {
    if(array_key_exists($key, $_SESSION['APP'])) unset($_SESSION['APP'][$key]);
    $this->updateActivity();
  }
  
  public function getAll() {
    $this->updateActivity();
    return $_SESSION['APP'];
  }
  
  public function clear() {
    $_SESSION['APP'] = array();
    $this->updateActivity();
  }
  
  public function destroy() {
    session_unset();
    session_destroy();
    $this->clear();
  }
  
  protected function updateActivity() {
    if(isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) { // more than 30 minutes ago
        session_unset();
        session_destroy();
    }
    $_SESSION['LAST_ACTIVITY'] = time();
  }
}