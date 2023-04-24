<?php

namespace App\Observers;

use App\Models\Party;
use Illuminate\Support\Str;

class PartyObserver
{
    
    public function creating(Party $party)
    {
        $party->sigla= Str::upper($party->sigla);
    }

    public function updating(Party $party)
    {
        $party->sigla= Str::upper($party->sigla);
    }
   
  
}
