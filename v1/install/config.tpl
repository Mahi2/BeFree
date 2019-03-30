<?php
$host     = "<DB_HOST>"; // Database Host
$user     = "<DB_USER>"; // Database Username
$password = "<DB_PASSWORD>"; // Database's user Password
$database = "<DB_NAME>"; // Database Name
$prefix   = "<DB_PREFIX>"; // Database Prefix for the script tables

$mysqli = (new class($host, $user, $password, $database) {
    private $connexion;
    public function __construct($host, $user, $password, $database)
    {
       $this->host = $host;
       $this->user = $user;
       $this->password = $password;
       $this->database = $database;
    }

    public function getConnexion() {
        if (is_null($this->connexion)) {
            $this->connexion = new Mysqli($this->host, $this->user, $this->password, $this->database);
            $this->connexion->set_charset("utf8");
            if ($this->connexion->connect_errno) {
                echo "Failed to connect to MySQL: " . $this->connexion->connect_error;
                exit();
            }  
            return $this->connexion;
        } 
        return $this->connexion;  
    }
})->getConnexion();

$site_url             = "<SITE_URL>";
$projectsecurity_path = "<PROJECTSECURITY_PATH>";
?>
