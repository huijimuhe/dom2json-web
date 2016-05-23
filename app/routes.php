  
<?php

/* * ************************
 *  HOME ROUTE
 * ************************ */
Route::get('/', ['as' => 'dashboard', 'uses' => 'HomeController@dashboard']); 
/* * ************************
 *  ARTICLE ROUTE
 * ************************ */
Route::get('articlelist/{page?}', ['uses' => 'ArticlesController@getPages']);
Route::resource('articles', 'ArticlesController');
/* * ************************
 *  IMAGE TOKEN ROUTE
 * ************************ */
Route::get('token', ['as' => 'oss.token', 'uses' => 'HomeController@getOssToken']);
