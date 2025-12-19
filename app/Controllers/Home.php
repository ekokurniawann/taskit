<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Data Dummy untuk testing UI agar tidak blank
        $data = [
            'title' => 'Dashboard',
            'tasks' => []
        ];

        return view('pages/dashboard/index', $data);
    }
}