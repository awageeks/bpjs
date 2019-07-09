<?php namespace Awageeks\Bpjs;

/**
 *
 */
class Bpjs {

    public $config;
    public $signature;
    public $authorization;
    public $consId;
    public $timeStamp;
    public $secretKey;
    public $username;
    public $password;
    public $appCode;
    public $appUrl;

    /**
     *
     */
    public function __construct() {
        $this->setConfig();
        $this->setSignature();
        $this->setAuthorization();
        $this->setConsId();
        $this->setTimeStamp();
        $this->setSecretKey();
        $this->setUsername();
        $this->setPassword();
        $this->setAppCode();
        $this->setAppUrl();
    }

    /**
     *
     */
    public function get() {
        return $this;
    }

    /**
     *
     */
    public function setSignature() {
        $this->signature = $this->getSignature();
    }

    /**
     *
     */
    public function getSignature() {
        $consumerId = $this->getConsId();
        $timestamp = $this->getTimeStamp();

        // set data
        $data = "{$consumerId}&{$timestamp}";
        $secretKey = $this->getSecretKey();

        // Computes the signature by hashing the salt with the secret key as the key
        $signature = hash_hmac('sha256', $data, $secretKey, true);

        // base64 encode…
        $encodedSignature = base64_encode($signature);

        // urlencode…
        // $encodedSignature = urlencode($encodedSignature);

        return $encodedSignature;
    }

    /**
     *
     */
    public function setAuthorization() {
        $this->authorization = $this->getAuthorization();
    }

    /**
     *
     */
    public function getAuthorization() {
        $encodedAuth = base64_encode($this->getUsername() . ':' . $this->getPassword() . ':' . $this->getAppCode());
        return "Basic {$encodedAuth}";
    }

    /**
     *
     */
    public function setConfig() {
        $this->config = config('bpjs');
    }

    /**
     *
     */
    public function getConfig() {
        return $this->config;
    }

    /**
     *
     */
    public function setConsId() {
        $this->consId = $this->getConsId();
    }

    /**
     *
     */
    public function getConsId() {
        return $this->getConfig()['cons_id'];
    }

    /**
     *
     */
    public function setTimeStamp() {
        $this->timeStamp = $this->getTimeStamp();
    }

    /**
     * Get formatted timestamp.
     */
    public function getTimeStamp() {
        // Computes the timestamp
        date_default_timezone_set('UTC');
        $timestamp = strval(time()-strtotime('1970-01-01 00:00:00'));
        return $timestamp;
    }

    /**
     *
     */
    public function setSecretKey() {
        $this->secretkey = $this->getSecretKey();
    }

    /**
     *
     */
    public function getSecretKey() {
        return $this->getConfig()['secret_key'];
    }

    /**
     *
     */
    public function setUsername() {
        $this->username = $this->getUsername();
    }

    /**
     *
     */
    public function getUsername() {
        return $this->getConfig()['username'];
    }

    /**
     *
     */
    public function setPassword() {
        $this->password = $this->getPassword();
    }

    /**
     *
     */
    public function getPassword() {
        return $this->getConfig()['password'];
    }

    /**
     *
     */
    public function setAppCode() {
        $this->appCode = $this->getAppCode();
    }

    /**
     *
     */
    public function getAppCode() {
        return $this->getConfig()['app_code'];
    }

    /**
     *
     */
    public function setAppUrl() {
        $this->appUrl = $this->getAppUrl();
    }

    /**
     *
     */
    public function getAppUrl() {
        return $this->getConfig()['app_url'];
    }
}
