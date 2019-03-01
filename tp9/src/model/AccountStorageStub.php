<?php

require("AccountStorage.php");

class AccountStorageStub implements AccountStorage
{
  private $accounts;

  public function __construct() {
    $this->accounts = array (
      "denver" => new Account("Denver","dinosaure","1234","nul"),
      "medor" => new Accout("Médor","chien","1234","admin"),
      "felix" => new Accout("Félix","chat","1234","nul"),
    );
  }

  public function read($id) {
    if (key_exists($id, $this->accouts)) {
      return $this->accounts[$id];
    } else {
      return null;
    }
  }

  public function readAll() {
    return $this->accounts;
  }

  public function create(Account $a){

  }

  public function checkAuth($login,$password){

  }
}
