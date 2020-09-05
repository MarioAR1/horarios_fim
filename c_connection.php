<?php
class Connection
{
  private static $pdo, $tquery, $dbHost, $dbName, $dbUser, $dbPass;
  
  public function __construct($Host, $Name, $User, $Pass)
  {
    self::$dbHost = $Host;
    self::$dbName = $Name;
    self::$dbUser = $User;
    self::$dbPass = $Pass;
  }
  
  public static function open()
  {
    $charset = 'utf8mb4';

    $dsn = 'mysql:host='.self::$dbHost.';dbname='.self::$dbName.';charset='.$charset;
    $options =
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try
    {
      self::$pdo = new PDO($dsn, self::$dbUser, self::$dbPass, $options);
    }
    catch (\PDOException $e)
    {
      throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
    
    return self::$pdo;
  }
  
  public static function close()
  {
    self::$pdo = NULL;
  }
  
  public static function fetch()
  {
    return self::$tquery->fetch();
  }
  
  public function query($request)
  {
    self::$tquery = self::$pdo->query($request);
  }
}
?>