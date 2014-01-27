<?php

/**
 * @file
 * Sample OAuth2 Library PDO DB Implementation.
 */

// Set these values to your database access info.
//include '../engine/classes/configure.class.php';
define("PDO_DSN", 'mysql:dbname='.configure::$db['db_name'].';host='.configure::$db['db_host']);
define("PDO_USER", configure::$db['db_user']);
define("PDO_PASS", configure::$db['db_pass']);

include "../engine_oauth2/lib/oauth.php";

/**
 * OAuth2 Library PDO DB Implementation.
 */
class PDOOAuth2 extends OAuth2 {

  private $db;

  /**
   * Overrides OAuth2::__construct().
   */
  public function __construct() {
    parent::__construct();

    try {
      $this->db = new PDO(PDO_DSN, PDO_USER, PDO_PASS);
    } catch (PDOException $e) {
      die('Connection failed: ' . $e->getMessage());
    }
  }

  /**
   * Release DB connection during destruct.
   */
  function __destruct() {
    $this->db = NULL; // Release db connection
  }

  /**
   * Handle PDO exceptional cases.
   */
  private function handleException($e) {
    echo "Database error: " . $e->getMessage();
    exit;
  }

  /**
   * Little helper function to add a new client to the database.
   *
   * Do NOT use this in production! This sample code stores the secret
   * in plaintext!
   *
   * @param $client_id
   *   Client identifier to be stored.
   * @param $client_secret
   *   Client secret to be stored.
   * @param $redirect_uri
   *   Redirect URI to be stored.
   */
  public function addClient($client_id, $client_secret, $redirect_uri) {
    try {
      $sql = "INSERT INTO clients (client_id, client_secret, redirect_uri) VALUES (:client_id, :client_secret, :redirect_uri)";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(":client_id", $client_id, PDO::PARAM_STR);
      $stmt->bindParam(":client_secret", $client_secret, PDO::PARAM_STR);
      $stmt->bindParam(":redirect_uri", $redirect_uri, PDO::PARAM_STR);
      $stmt->execute();
    } catch (PDOException $e) {
      $this->handleException($e);
    }
  }

  /**
   * Implements OAuth2::checkClientCredentials().
   *
   * Do NOT use this in production! This sample code stores the secret
   * in plaintext!
   */
  protected function checkClientCredentials($client_id, $client_secret = NULL) {
    try {
      $sql = "SELECT client_secret FROM clients WHERE client_id = :client_id";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(":client_id", $client_id, PDO::PARAM_STR);
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($client_secret === NULL)
          return $result !== FALSE;

      return $result["client_secret"] == $client_secret;
    } catch (PDOException $e) {
      $this->handleException($e);
    }
  }

  /**
   * Implements OAuth2::getRedirectUri().
   */
  protected function getRedirectUri($client_id) {
    try {
      $sql = "SELECT redirect_uri FROM clients WHERE client_id = :client_id";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(":client_id", $client_id, PDO::PARAM_STR);
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($result === FALSE)
          return FALSE;

      return isset($result["redirect_uri"]) && $result["redirect_uri"] ? $result["redirect_uri"] : NULL;
    } catch (PDOException $e) {
      $this->handleException($e);
    }
  }

  /**
   * Implements OAuth2::getAccessToken().
   */
  protected function getAccessToken($oauth_token) {
    try {
      $sql = "SELECT client_id, expires, scope FROM tokens WHERE oauth_token = :oauth_token";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(":oauth_token", $oauth_token, PDO::PARAM_STR);
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      return $result !== FALSE ? $result : NULL;
    } catch (PDOException $e) {
      $this->handleException($e);
    }
  }

    /**
     * Функция возвращает ID приложения (АВАТОРИЯ)
     * @param $client_id
     * @return mixed|null
     */
    protected function getAppID($client_id){
       try {
           $sql = "SELECT id FROM clients WHERE client_id = :client_id";
           $stmt = $this->db->prepare($sql);
           $client_id = 'app'.$client_id;
           $stmt->bindParam(":client_id", $client_id, PDO::PARAM_STR);
           $stmt->execute();

           $result = $stmt->fetch(PDO::FETCH_ASSOC);
           //$result = $result['id'];
           return $result !== FALSE ? $result : NULL;
       } catch (PDOException $e) {
           $this->handleException($e);
       }
   }

  /**
   * Implements OAuth2::setAccessToken().
   */
  protected function setAccessToken($oauth_token, $client_id, $expires, $scope = NULL) {
    try {
      $sql = "INSERT INTO tokens (oauth_token, client_id, expires, scope) VALUES (:oauth_token, :client_id, :expires, :scope)";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(":oauth_token", $oauth_token, PDO::PARAM_STR);
      $stmt->bindParam(":client_id", $client_id, PDO::PARAM_STR);
      $stmt->bindParam(":expires", $expires, PDO::PARAM_INT);
      $stmt->bindParam(":scope", $scope, PDO::PARAM_STR);

      $stmt->execute();
    } catch (PDOException $e) {
      $this->handleException($e);
    }
  }

  /**
   * Overrides OAuth2::getSupportedGrantTypes().
   */

  protected function getSupportedGrantTypes() {
    return array(
      OAUTH2_GRANT_TYPE_AUTH_CODE,
      OAUTH2_GRANT_TYPE_CLIENT_CREDENTIALS,
    );
  }

  /**
   * Overrides OAuth2::getAuthCode().
   */
  protected function getAuthCode($code) {
    try {
      $sql = "SELECT code, client_id, redirect_uri, expires, scope FROM auth_codes WHERE code = :code";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(":code", $code, PDO::PARAM_STR);
      $stmt->execute();

      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      return $result !== FALSE ? $result : NULL;
    } catch (PDOException $e) {
      $this->handleException($e);
    }
  }

  /**
   * Overrides OAuth2::setAuthCode().
   */
  protected function setAuthCode($code, $client_id, $redirect_uri, $expires, $scope = NULL) {
    try {
      $sql = "INSERT INTO auth_codes (code, client_id, redirect_uri, expires, scope) VALUES (:code, :client_id, :redirect_uri, :expires, :scope)";
      $stmt = $this->db->prepare($sql);
      $stmt->bindParam(":code", $code, PDO::PARAM_STR);
      $stmt->bindParam(":client_id", $client_id, PDO::PARAM_STR);
      $stmt->bindParam(":redirect_uri", $redirect_uri, PDO::PARAM_STR);
      $stmt->bindParam(":expires", $expires, PDO::PARAM_INT);
      $stmt->bindParam(":scope", $scope, PDO::PARAM_STR);

      $stmt->execute();
    } catch (PDOException $e) {
      $this->handleException($e);
    }
  }
}
