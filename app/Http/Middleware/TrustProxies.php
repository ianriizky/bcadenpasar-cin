<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * {@inheritDoc}
     */
    protected $proxies = '*';

    /**
     * {@inheritDoc}
     */
    protected $headers = Request::HEADER_X_FORWARDED_AWS_ELB;
}
