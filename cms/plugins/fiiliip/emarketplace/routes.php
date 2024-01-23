<?php
    Route::group([
        'prefix' => 'api/v1/mall',
        'namespace' => 'Fiiliip\EMarketplace\Http\Controllers'
    ], function() {
        Route::get('/categories', 'ApiController@getCategories');
        Route::put('/category/{id}', 'ApiController@updateCategory');
        Route::delete('/category/{id}', 'ApiController@deleteCategory');
        Route::post('/category', 'ApiController@addCategory');

        Route::get('/listings', 'ApiController@getListings');
        Route::get('/listing/{id}', 'ApiController@getListing');

        Route::post('/listing', 'ApiController@createListing');
        
        Route::put('/listing/{id}', 'ApiController@updateListing');

        Route::delete('/listing/{id}', 'ApiController@deleteListing');

        Route::get('/isUserAdmin/{id}', 'ApiController@isUserAdmin');
    });
?>