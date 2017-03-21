<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It is a breeze. Simply tell Lumen the URIs it should respond to
  | and give it the Closure to call when that URI is requested.
  |
 */

//use Illuminate\Support\Facades\Redis;
//
//$app->get('/', function () use ($app) {
//    return $app->version();
//});
//show stats page
$app->get('/stats/{skill}', 'StatsController@index');
$app->get('/stats', 'StatsController@index');
$app->get('/scrape', 'ScraperController@scrapeMain');

//testing
$app->get('/seed', 'ScraperController@seed');
$app->get('/emptydb', 'ScraperController@emptyDB');
//
//$app->get('/red', function() {
//    $redis = Redis::connection();
//
//    $postKey = 'four';
//    if (Redis::sismember('test', $postKey) === 0)
//    {
//        //scrape
//        Redis::sadd('test', $postKey);
//    }
//    Redis::get('olga');
//    dd(Redis::sismember('test', $postKey));
//});
