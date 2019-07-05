<?php

namespace Awageeks\Bpjs\Facades;

use Illuminate\Support\Facades\Facade as BaseFacade;

class Bpjs extends BaseFacade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'bpjs'; }


}
