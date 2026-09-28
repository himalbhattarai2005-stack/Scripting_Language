<?php
class User {
    protected $name, $surname, $username, $is_admin = false;

    public function __construct($name, $surname, $username) {
        $this->name = $name;
        $this->surname = $surname;
        $this->username = $username;
    }

    public function isAdmin() {
        return $this->is_admin;
    }

    public function fullName() {
        return $this->name . " " . $this->surname .
            ($this->is_admin ? " (admin)" : "");
    }
}

class Customer extends User {
    private $city, $state, $country;

    public function __construct($name, $surname, $username) {
        parent::__construct($name, $surname, $username);
    }

    public function setCity($v) { $this->city = $v; }
    public function getCity() { return $this->city; }
    public function setState($v) { $this->state = $v; }
    public function getState() { return $this->state; }
    public function setCountry($v) { $this->country = $v; }
    public function getCountry() { return $this->country; }

    public function location() {
        return "$this->city, $this->state, $this->country";
    }
}

class AdminUser extends User {
    public function __construct($name, $surname, $username) {
        parent::__construct($name, $surname, $username);
        $this->is_admin = true;
    }
}

$user = new User("Himal", "Bhattarai", "himal001");

$customer = new Customer("Hari", "Parsad", "hari001");
$customer->setCity("Kathmandu");
$customer->setState("Bagmati");
$customer->setCountry("Nepal");

$admin = new AdminUser("Admin", "User", "admin01");

echo "User: {$user->fullName()} | is_admin: " .
    ($user->isAdmin() ? "true" : "false") . "<br>";
echo "Customer: {$customer->fullName()} | is_admin: " .
    ($customer->isAdmin() ? "true" : "false") . "<br>";
echo "Location: {$customer->location()}<br>";
echo "Admin: {$admin->fullName()} | is_admin: " .
    ($admin->isAdmin() ? "true" : "false");
?>