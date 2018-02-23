<?php

namespace App\Http\Controllers;

use App\Artigo;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaPagina = json_encode([
            ['titulo' => 'Admin', 'url' => ""]
        ]);

        $totalUsuarios = User::count();
        $totalArtigos = Artigo::count();
        $totalAutores = User::where('autor', '=', 'S')->count();
        $totalAdmins = User::where('admin', '=', 'S')->count();

        return view('admin', compact('listaPagina', 'totalArtigos', 'totalAutores', 'totalUsuarios', 'totalAdmins'));
    }
}
