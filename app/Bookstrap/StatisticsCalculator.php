<?php

namespace App\Bookstrap;

use Illuminate\Support\Facades\Auth;

class StatisticsCalculator {

  public static function dashBoardStatistics() {
    $user = Auth::user();

    $totalBooks = $user->books()->withContent()->count();
    $totalPages = $user->books()->withContent()->sum('total_pages');
    $totalSize = $user->books()->withContent()->sum('total_size');

    $subscription = $user->subscription();
    $percentDiskOccupied = ( $totalSize / $subscription['disk_quote'] ) * 100;


    return compact('totalBooks', 'totalPages', 'totalSize', 'percentDiskOccupied');
  }
}
