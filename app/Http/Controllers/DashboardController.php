<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\Client;
use App\Models\Virement;

class DashboardController extends Controller
{
    public function index()
    {
        $comptesCount = Compte::count();
        $clientsCount = Client::count();
        $virementsCount = Virement::count();

        return view('dashboard', compact('comptesCount', 'clientsCount', 'virementsCount'));
    }
}
