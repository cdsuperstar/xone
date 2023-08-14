<?php

//xapp1s1
use App\Http\Controllers\xapp1s1\Xapp1s1profileController;
use App\Http\Controllers\xapp1s1\Xapp1s1categController;
use App\Http\Controllers\xapp1s1\Xapp1s1shopController;
use App\Http\Controllers\xapp1s1\Xapp1s1productController;
use App\Http\Controllers\xapp1s1\Xapp1s1momentController;
use App\Http\Controllers\xapp1s1\Xapp1s1activateController;

// XApp1s1
Route::prefix('xapp1s1')->group(function () {
    // 用户个人资料
    Route::apiResource('profile', Xapp1s1profileController::class)->except(['show']);
    Route::controller(Xapp1s1profileController::class)->prefix('profile')->group(function () {
        Route::get('getMyProfile', 'getMyProfile');
        Route::post('updateMyProfile', 'updateMyProfile');
        Route::post('updateMyAvatar', 'updateMyAvatar');
        Route::get('getTheUserProfile/{user}', 'getTheUserProfile');
        Route::get('getMyLikedUsers','getMyLikedUsers');
    });

    // 类别管理
    Route::apiResource('categs', Xapp1s1categController::class)->except(['show'])->parameters([
        'categs' => 'xapp1s1categ'
    ]);
    Route::prefix('categs')->group(function () {
    });

    // 商铺管理
    Route::apiResource('shops', Xapp1s1shopController::class)->except(['show'])->parameters([
        'shops' => 'xapp1s1shop'
    ]);
    Route::controller(Xapp1s1shopController::class)->prefix('shops')->group(function () {
        Route::get('getMyShop', 'getMyShop');
        // 得到具体的店铺资料
        Route::get('getTheShop/{xapp1s1shop}', 'getTheShop');
        Route::post('updateMyShop', 'updateMyShop');

        Route::post('uploadMyShopFiles/{collectionname}', 'uploadMyShopFiles');
        Route::post('delMyShopFiles/{collectionname}', 'delMyShopFiles');
        Route::get('getMyShopFiles/{collectionname}', 'getMyShopFiles');

        Route::post('saveMyShopProduct/{xapp1s1shop}', 'saveMyShopProduct');
        Route::post('delMyShopProduct/{xapp1s1product}', 'delMyShopProduct');
        Route::get('getMyShopProducts/{xapp1s1shop}', 'getMyShopProducts');

        Route::get('getMyactivates', 'getMyactivates');
    });

    // 商品管理
    Route::apiResource('products', Xapp1s1productController::class)->except(['show'])->parameters([
        'products' => 'xapp1s1product',
    ]);
    Route::controller(Xapp1s1productController::class)->prefix('products')->group(function () {
        Route::post('uploadProductFiles/{xapp1s1product}', 'uploadProductFiles');
        Route::post('delProductFiles/{xapp1s1product}', 'delProductFiles');
        Route::get('getProductFiles/{xapp1s1product}', 'getProductFiles');
    });

    // 动态管理
    Route::apiResource('moments', Xapp1s1momentController::class)->except(['show'])->parameters([
        'moments' => 'xapp1s1moment',
    ]);
    Route::controller(Xapp1s1momentController::class)->prefix('moments')->group(function () {
        Route::post('postMyMoment', 'postMyMoment');
        Route::post('updateMyMoment/{xapp1s1moment}', 'updateMyMoment');
        Route::post('delMyMoment/{xapp1s1moment}', 'delMyMoment');
        Route::post('thumbUpMoment/{xapp1s1moment}', 'thumbUpMoment');

        Route::post('commentMoment/{xapp1s1moment}', 'commentMoment');
        Route::post('delCommentMoment/{comment}', 'delCommentMoment');

        Route::get('getMyPostedMoments', 'getMyPostedMoments');
        Route::get('getFocusedMoments', 'getFocusedMoments');
        Route::get('getRecommMoments', 'getRecommMoments');
        Route::get('getShopMoments', 'getShopMoments');
    });

    // 活动管理
    Route::apiResource('activates', Xapp1s1activateController::class)->except(['show'])->parameters([
        'activates' => 'xapp1s1activate',
    ]);
    Route::controller(Xapp1s1activateController::class)->prefix('activates')->group(function () {
        Route::post('saveMyActivate/{xapp1s1activate?}', 'saveMyActivate');
        Route::post('delMyActivate/{xapp1s1activate}', 'delMyActivate');

        Route::post('uploadMyActivateFiles/{xapp1s1activate}', 'uploadMyActivateFiles');
        Route::post('delMyActivateFiles/{xapp1s1activate}', 'delMyActivateFiles');
        Route::get('getMyActivateFiles/{xapp1s1activate}', 'getMyActivateFiles');


        Route::post('searchFitActivates', 'searchFitActivates');
    });

});

?>
