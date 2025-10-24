<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;

class AuthorDashboardController extends Controller
{
  private DashboardService $dashboardService;

  public function __construct(DashboardService $dashboardService)
  {
    $this->dashboardService = $dashboardService;
  }

  public function overview()
  {
    $dashboardData = $this->dashboardService->getDashboardData(Auth::user());

    return view('dashboard.author.overview', ['dashboardData' => $dashboardData]);
  }

  public function posts()
  { 
    $posts = Post::latest()->paginate(10);

    return view('dashboard.author.posts', ['posts' => $posts]);
  }

  public function activity()
  {
    $dashboardData = $this->dashboardService->getDashboardData(Auth::user());

    return view('dashboard.author.activity', ['dashboardData' => $dashboardData]);
  }
}