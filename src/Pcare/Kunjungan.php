<?php namespace Awageeks\Bpjs\Pcare;

use Awageeks\Bpjs\Bpjs;

class Kunjungan extends Bpjs
{
    public function __construct($config)
    {
        parent::__construct($config);
        $this->app_url .= "kunjungan";
        return $this;
    }

    public function get()
    {
        // set headers
        $this->setHeaders();
        return parent::get();
    }

    public function getRujukan($nomorKunjungan)
    {
        $this->app_url .= "/rujukan/{$nomorKunjungan}";
        return $this->get();
    }

    public function getRiwayatKunjungan($nomorkartu)
    {
        $this->app_url .= "/peserta/{$nomorkartu}";
        return $this->get();
    }
}
