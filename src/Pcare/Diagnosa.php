<?php namespace Awageeks\Bpjs\Pcare;

use Awageeks\Bpjs\Bpjs;

class Diagnosa extends Bpjs
{
    public function __construct($keyword, $start, $limit, $config)
    {
        parent::__construct($config);
        $this->app_url .= "diagnosa/{$keyword}/{$start}/{$limit}";
        // set headers
        $this->setHeaders();
        return $this;
    }
}
