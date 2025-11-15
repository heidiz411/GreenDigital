
<?php
require_once __DIR__ . '/Config.php';
class Database {
    private static ?PDO $pdo = null;
    public static function connection(): PDO {
        if (self::$pdo === null) {
            $dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', Config::DB_HOST, Config::DB_NAME, Config::DB_CHARSET);
            $opts = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            self::$pdo = new PDO($dsn, Config::DB_USER, Config::DB_PASS, $opts);
        }
        return self::$pdo;
    }
}
