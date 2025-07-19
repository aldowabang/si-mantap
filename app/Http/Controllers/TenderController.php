<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class TenderController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Tender',
            'description' => 'Halaman Tender',
        ];
        return view('tender.index', $data);
    }
}
