<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminDashboardService;

class AdminDashboardController extends Controller
{
  public function __construct(private AdminDashboardService $adminDashboardService)
  {}

  public function overview()
  {
    $overviewData = $this->adminDashboardService->getOverviewData();

    return view('dashboard.author.overview', ['overviewData' => $overviewData]);
  }

  public function posts()
  {
    
  }

  public function users()
  {
    
  }

  public function categoriesTags()
  {
    
  }
}