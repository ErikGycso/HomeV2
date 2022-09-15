<?php

namespace App\Http\Controllers;

use App\Http\Utilidades\UtilidadGeneral;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SiteController extends Controller
{
    public function getMenu()
    {        
        if (!Cache::has('menu')) {
            UtilidadGeneral::updateMenu();
        }
        return Cache::get('menu');
    }
}
