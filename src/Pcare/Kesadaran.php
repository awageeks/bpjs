<?php namespace Awageeks\Bpjs\Pcare;

use Awageeks\Bpjs\Bpjs;

class Kesadaran extends Bpjs
{
    public function __construct($config)
    {
        parent::__construct($config);
        $this->app_url .= "kesadaran";
        // set headers
        $this->setHeaders();
        return $this;
    }
}
