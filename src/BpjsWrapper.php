<?php namespace Awageeks\Bpjs;

class BpjsWrapper
{
    protected $config = [];

    public function __construct($config = [])
    {
        // merge config array
        $this->config = config('bpjs') + $config;
    }

    public function diagnosa($keyword, $start, $limit)
    {
        return new \Awageeks\Bpjs\Pcare\Diagnosa($keyword, $start, $limit, $this->config);
    }
}
