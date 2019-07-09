<?php namespace Awageeks\Bpjs\Pcare;

use Awageeks\Bpjs\Bpjs;

class Dokter extends Bpjs
{
    public function __construct($start, $limit, $config)
    {
        parent::__construct($config);
        $this->app_url .= "dokter/{$start}/{$limit}";
        // set headers
        $this->setHeaders();
        return $this;
    }
}
