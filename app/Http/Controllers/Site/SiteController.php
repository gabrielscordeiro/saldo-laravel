<?php

namespace App\Http\Controllers\Site;

/**
 *
 * @author Gabriel Schmidt Cordeiro <gabrielscordeiro2012@gmail.com>
 * 
 */

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{

    public function index()
    {
        return view('site.home.index');
    }

}
