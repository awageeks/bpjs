<?php
namespace Awageeks\Bpjs;

use GuzzleHttp\Client;

class Bpjs
{
    /**
     * Guzzle HTTP Client object
     * @var \GuzzleHttp\Client
     */
    protected $clients;

    /**
     * Request headers
     * @var array
     */
    protected $headers;

    /**
     * X-cons-id header value
     * @var int
     */
    protected $cons_id;

    /**
     * X-Timestamp header value
     * @var string
     */
    protected $timestamp;

    /**
     * X-Signature header value
     * @var string
     */
    protected $signature;

    /**
     * X-Authorization header value
     * @var string
     */
    protected $authorization;

    /**
     * @var string
     */
    protected $secret_key;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $app_code = '095';

    /**
     * @var string
     */
    protected $app_url;

    /**
     * @var string
     */
    protected $service_name;

    public function __construct($config)
    {
        $this->clients = new Client([
            'verify' => false
        ]);
        
        foreach ($config as $key => $val){
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }
    }

    protected function setHeaders()
    {
        // set X-Timestamp, X-Signature, and finally the headers
        $this->setTimestamp()->setSignature()->setAuthorization();
        $this->headers = [
            'X-cons-id'       => $this->cons_id,
            'X-Timestamp'     => $this->timestamp,
            'X-Signature'     => $this->signature,
            'X-Authorization' => $this->authorization
        ];
        return $this;
    }

    protected function setTimestamp()
    {
        date_default_timezone_set('UTC');
        $this->timestamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        return $this;
    }

    protected function setSignature()
    {
        $data = "{$this->cons_id}&{$this->timestamp}";
        $signature = hash_hmac('sha256', $data, $this->secret_key, true);
        $encodedSignature = base64_encode($signature);
        $this->signature = $encodedSignature;
        return $this;
    }

    protected function setAuthorization()
    {
        $data = "{$this->username}:{$this->password}:{$this->app_code}";
        $encodedAuth = base64_encode($data);
        $this->authorization = "Basic {$encodedAuth}";
        return $this;
    }

    public function get()
    {
        $this->headers['Content-Type'] = 'application/json; charset=utf-8';
        try {
            $response = $this->clients->request(
                'GET',
                $this->app_url,
                [
                    'headers' => $this->headers
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getResponse()->getBody();
        }
        return $response;
    }

    protected function post($feature, $data = [], $headers = [])
    {
        $this->headers['Content-Type'] = 'application/x-www-form-urlencoded';
        if(!empty($headers)){
            $this->headers = array_merge($this->headers,$headers);
        }
        try {
            $response = $this->clients->request(
                'POST',
                $this->base_url . '/' . $this->service_name . '/' . $feature,
                [
                    'headers' => $this->headers,
                    'json' => $data,
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getResponse()->getBody();
        }
        return $response;
    }

    protected function put($feature, $data = [])
    {
        $this->headers['Content-Type'] = 'application/x-www-form-urlencoded';
        try {
            $response = $this->clients->request(
                'PUT',
                $this->base_url . '/' . $this->service_name . '/' . $feature,
                [
                    'headers' => $this->headers,
                    'json' => $data,
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getResponse()->getBody();
        }
        return $response;
    }


    protected function delete($feature, $data = [])
    {
        $this->headers['Content-Type'] = 'application/x-www-form-urlencoded';
        try {
            $response = $this->clients->request(
                'DELETE',
                $this->base_url . '/' . $this->service_name . '/' . $feature,
                [
                    'headers' => $this->headers,
                    'json' => $data,
                ]
            )->getBody()->getContents();
        } catch (\Exception $e) {
            $response = $e->getResponse()->getBody();
        }
        return $response;
    }
}
