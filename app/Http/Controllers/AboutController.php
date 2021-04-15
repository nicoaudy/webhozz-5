<?php

namespace App\Http\Controllers;

class AboutController extends Controller
{
    public function index()
    {
        $name = request('name');
        $age = request('age');
        $buah = ['Anggur', 'Pear', 'Apel', 'Timun'];
        $cuaca = 'Musim Gugur';

        return view('about', [
            'name' => $name,
            'age' => $age,
            'buah' => $buah,
            'cuaca' => $cuaca
        ]);
    }
}
