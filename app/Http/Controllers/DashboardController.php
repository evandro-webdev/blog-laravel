<?php

namespace App\Http\Controllers;

use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  private DashboardService $dashboardService;

  public function __construct(DashboardService $dashboardService)
  {
    $this->dashboardService = $dashboardService;
  }

  public function dashboard()
  {
    $dashboardData = $this->dashboardService->getDashboardData(Auth::user());

    return view('admin.dashboard', [
      'dashboardData' => $dashboardData
    ]);
  }
}