<?php namespace Awageeks\Bpjs;

class BpjsWrapper
{
    protected $config = [];

    public function __construct($config = [])
    {
        // merge config array
        $this->config = config('bpjs') + $config;
    }

    public function diagnosa($keyword, $start = 0, $limit = 10)
    {
        return new \Awageeks\Bpjs\Pcare\Diagnosa($keyword, $start, $limit, $this->config);
    }

    public function dokter($start = 0, $limit = 10)
    {
        return new \Awageeks\Bpjs\Pcare\Dokter($start, $limit, $this->config);
    }

    public function kesadaran()
    {
        return new \Awageeks\Bpjs\Pcare\Kesadaran($this->config);
    }

    public function kunjungan()
    {
        return new \Awageeks\Bpjs\Pcare\Kunjungan($this->config);
    }
}
