<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../config/config.php');
?>

<?php
class Database {
    public $host = DB_HOST;
    public $user = DB_USER;
    public $pass = DB_PASS;
    public $name = DB_NAME;

    public $link;
    public $error;

    public function __construct()
    {
        $this->connect();
    }

    private function connect() {
        $this->link = new mysqli($this->host, $this->user, $this->pass, $this->name);
        if(!$this->link) {
            $this->error = "Connection failed: " . $this->link->connect_error;
            return false;
        }
    }

    public function select($query) {
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        if($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function insert($query) {
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        if($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function update($query) {
        $result = $this->link->query($query) or die($this->link->error.__LINE__);
        if($result) {
            return $result;
        } else {
            return false;
        }
    }



}

?>