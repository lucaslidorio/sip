<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $table = 'plans';
    protected $fillable = ['nome', 'url', 'preco', 'descricao'];

    public function profiles(){
        return $this->BelongsToMany(Profile::class, 'plan_profile' );
    }

    public function profilesAvailable($pesquisa = null){   
        $profiles = Profile::whereNotIn('profiles.id', function($query){
            $query->select('plan_profile.profile_id');
            $query->from('plan_profile');
            $query->whereRaw("plan_profile.plan_id ={$this->id}");
        })
        ->where(function($queryFilter) use($pesquisa){
            if($pesquisa)
                $queryFilter->where('profiles.nome', 'LIKE', "%{$pesquisa}%");
        })
        ->paginate(10);
        return $profiles;
    }
}
