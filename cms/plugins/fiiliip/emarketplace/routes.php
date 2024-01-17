<?php
    Route::group([
        'prefix' => 'api/v1/mall',
        'namespace' => 'Fiiliip\EMarketplace\Http\Controllers'
    ], function() {
        Route::get('/categories', 'ApiController@getCategories');

        Route::get('/listings', 'ApiController@getListings');
        Route::get('/listing/{id}', 'ApiController@getListing');

        Route::post('/listing', 'ApiController@createListing');
    });
?>