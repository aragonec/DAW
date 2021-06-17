<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class UsuariosController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        if (Auth::user()->level != "admin"){return redirect('/admin');}
        return view('admin.users');
    }
}
