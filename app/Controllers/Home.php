<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // Data Dummy untuk testing UI agar tidak blank
        $data = [
            'title' => 'Dashboard',
            'tasks' => [
                [
                    'id' => 1,
                    'title' => 'Integrasi API Payment Gateway',
                    'deadline' => '25 Des 2025',
                    'priority' => 'high',
                    'status' => 'in_progress'
                ],
                [
                    'id' => 2,
                    'title' => 'Perbaikan UI Login Mobile',
                    'deadline' => '28 Des 2025',
                    'priority' => 'medium',
                    'status' => 'pending'
                ]
            ]
        ];

        return view('pages/dashboard/index', $data);
    }
}