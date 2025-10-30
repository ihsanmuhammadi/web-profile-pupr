<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function berita() {
        return view('pages.admin.berita');
    }

}
