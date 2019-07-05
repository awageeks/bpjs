<?php namespace Awageeks\Bpjs;

/**
 *
 */
class Bpjs {

    public $config;

    /**
     *
     */
    public function __construct() {
        $this->setConfig();
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
    public function getConsId() {
        return $this->getConfig()['cons_id'];
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
    public function getSecretKey() {
        return $this->getConfig()['secret_key'];
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
    public function getPassword() {
        return $this->getConfig()['password'];
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
    public function getAppUrl() {
        return $this->getConfig()['app_url'];
    }
}
