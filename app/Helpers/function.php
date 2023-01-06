<?php

function checkIfCentralDomain()
{
    $hostname = request()->getHost();
    if (in_array($hostname, config('tenancy.central_domains'))) {
        return true;
    } else {
        return false;
    }
}
