<?php

namespace App\Observers;

use App\Models\Secretary;
use Illuminate\Support\Str;

class SecretaryObserver
{
    /**
     * Handle the Secretary "creating" event.
     *
     * @param  \App\Models\Secretary  $secretary
     * @return void
     */
    public function creating(Secretary $secretary)
    {
        $secretary->sigla= Str::upper($secretary->sigla);
        $secretary->url= Str::lower($secretary->sigla);
        
    }

    /**
     * Handle the Secretary "updating" event.
     *
     * @param  \App\Models\Secretary  $secretary
     * @return void
     */
    public function updating(Secretary $secretary)
    {
        $secretary->sigla= Str::upper($secretary->sigla);
        $secretary->url= Str::lower($secretary->sigla);
    }
}
