<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Artigo extends Model
{
    use SoftDeletes;

    protected $fillable = ['titulo','descricao','conteudo','data'];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function listar($paginate)
    {
        $listaArtigos = Artigo::select('id','titulo','descricao', 'data', 'user_id')->paginate($paginate);

        foreach ($listaArtigos as $key => $listaArtigo) {
            $listaArtigo->user_id = User::find($listaArtigo->user_id)->name;
        }

//        $listaArtigos = DB::table('artigos')
//            ->join('users', 'users.id', '=', 'artigos.user_id')
//            ->select('artigos.id', 'artigos.titulo', 'artigos.descricao', 'artigos.data','users.name')
//            ->whereNull('deleted_at')
//            ->paginate(2);

        return $listaArtigos;
    }

    public static function listarArtigosSite($paginate)
    {
        $listaArtigos = DB::table('artigos')
            ->join('users', 'users.id', '=', 'artigos.user_id')
            ->select('artigos.id', 'artigos.titulo', 'artigos.descricao', 'artigos.data','users.name as autor')
            ->whereNull('deleted_at')
            ->whereDate('artigos.data', '<=', date('Y-m-d'))
            ->orderBy('data','DESC')
            ->paginate($paginate);

        return $listaArtigos;
    }


}
