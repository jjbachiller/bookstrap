<?php

namespace App\Auth;

use GuzzleHttp\Client;

class aMember {

  private static function makeAPICall($action, $parameters = [])
  {
    $client = new Client();

    $query = ['_key' => config('amember._key') ];
    $query = array_merge($query, $parameters);

    $amemberResponse = $client->request('GET', config('amember.base_url').$action, [
      'query' => $query,
    ]);
    $response = json_decode($amemberResponse->getBody()->getContents(), true);
    return $response;
  }

  public static function login($email, $password)
  {
    $loginData = ['login' => $email, 'pass' => $password];
    $actions = config('amember.actions');
    $response = self::makeAPICall($actions['login'], $loginData);

    return $response;
  }

  public static function getHigherSubscription($userSubscriptions)
  {
    $subscriptions = config('amember.subscriptions');
    foreach ($subscriptions as $subscription) {
      if (isset($userSubscriptions[$subscription])) {
        // FIXME: Check if date is expired, perhaps user has a lower
        // subscription active.
        $expireDate = $userSubscriptions[$subscription];
        return array($subscription, $expireDate);
      }
    }
    return array(null, null);
  }

}
