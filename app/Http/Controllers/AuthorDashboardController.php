<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Services\AuthorDashboardService;

class AuthorDashboardController extends Controller
{
  public function __construct(private AuthorDashboardService $authorDashboardService)
  {}

  public function overview()
  {
    $overviewData = $this->authorDashboardService->getOverviewData(Auth::user());

    return view('dashboard.author.overview', ['overviewData' => $overviewData]);
  }

  public function posts()
  { 
    $postsData = Post::latest()->paginate(10);

    return view('dashboard.author.posts', ['posts' => $postsData]);
  }

  public function activity()
  {
    $activitiesData = $this->authorDashboardService->getActivitiesData(Auth::user());

    return view('dashboard.author.activity', ['activitiesData' => $activitiesData]);
  }
}