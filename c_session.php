<?php
class Session
{
    public function __construct()
    {
      if (session_status() != PHP_SESSION_ACTIVE)
      {
        session_start();
      }
    }
       
    public static function started()
    {
      if (!isset($_SESSION['q1z']))
      {
        return FALSE;
      }
      
      return TRUE;
    }
    
    public static function start()
    {
      $_SESSION['q1z'] = 0;
    }
    
    public function __set($name , $value)
    {
        $_SESSION[$name] = $value;
    }
    
    public function __get($name)
    {
        if (isset($_SESSION[$name]))
        {
            return $_SESSION[$name];
        }
    }
    
    public function __isset($name)
    {
        return isset($_SESSION[$name]);
    }
    
    public function __unset($name)
    {
        unset($_SESSION[$name]);
    }
    
    public function destroy()
    {
        session_destroy();
    }
}
?>