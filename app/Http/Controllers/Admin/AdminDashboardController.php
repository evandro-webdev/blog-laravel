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

    return view('dashboard.admin.overview', ['overviewData' => $overviewData]);
  }

  public function posts()
  {
    $posts = $this->adminDashboardService->getPosts();

    return view('dashboard.admin.posts', ['posts' => $posts]);
  }

  public function users()
  {
    $users = $this->adminDashboardService->getUsers();

    return view('dashboard.admin.users', ['users' => $users]);
  }

  public function categoriesTags()
  {
    $categoriesData = $this->adminDashboardService->getCategoriesData();
    $tagsData = $this->adminDashboardService->getTagsData();
    
    return view('dashboard.admin.categories-tags.index', [
      'categoriesData' => $categoriesData,
      'tagsData' => $tagsData
    ]);
  }
}