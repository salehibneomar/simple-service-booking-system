<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';


Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});
