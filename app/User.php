<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // User books
    public function books()
    {
      return $this->hasMany('App\Book');
    }

    // Sections
    public function sections()
    {
      return $this->hasMany('App\Section');
    }

    // User Books Downloads
    public function downloads()
    {
      return $this->hasMany('App\Download');
    }

    public function subscription()
    {
      $subscriptionType = $this->subscription_type;
      if (is_null($subscriptionType)) {
        return false;
      }

      $subscriptions = config('amember.subscriptions');
      $subscription = [];
      foreach ($subscriptions as $sub) {
        if ($sub['id'] == $subscriptionType) {
          $subscription = $sub;
          break;
        }
      }

      if (empty($subscription)) {
        return false;
      }

      //Extraer la fecha de mysql a Carbon
      $endSubscriptionDate = Carbon::parse($this->subscribed_until);
      $subscription['next_billing'] = $endSubscriptionDate->add('1 day');
      return $subscription;
    }

    public function numDownloadsThisWeek() {
      $weekDownloads = $this->downloads
        ->whereBetween('download_at',
          [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->count();

      return $weekDownloads;
    }

    public function diskOccupation() {
      $diskOccuptaion = $this->books->sum('total_size');

      return $diskOccuptaion;
    }
}
