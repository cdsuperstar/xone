<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ZModuleController;
use App\Http\Controllers\ZRoleController;
use App\Http\Controllers\ZPermissionController;
use App\Http\Controllers\ZUnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ZeroController;
use App\Http\Controllers\ZUserprofileController;
use App\Http\Controllers\XapperrController;
use App\Http\Controllers\WeChatController;

require __DIR__.'/xapp1s1.php';

// 解决下载文件的中文名BUG
setlocale(LC_ALL, 'C.UTF-8');

if (env('APP_DEBUG')) {
    \Log::info('API Debug:', ['##Url' => Request::url(), '##Request' => Request::all(), '##Method' => Request::method(), '##Client IP' => Request::getClientIp(), '##isJson' => Request::isJson(), '##Login check' => auth()->check()]);
}
//Auth::routes();

// 系统基础功能
Route::post('oauth/token', [\Laravel\Passport\Http\Controllers\AccessTokenController::class, 'issueToken']);

//Route::post('oauth/refresh', '\Laravel\Passport\Http\Controllers\TransientTokenController@refresh');
Route::post('auth/logout', [LoginController::class, 'logout']);
Route::get('auth/logout', [LoginController::class, 'logout']);
Route::post('auth/register', [RegisterController::class, 'register']);
Route::post('broadcasting/auth', [\Illuminate\Broadcasting\BroadcastController::class, 'authenticate']);

//需要认证
Route::group(['middleware' => ['auth:api_v1']], function () {
// 得到用户配置
    Route::get('auth/user', [UserController::class, 'self']);
// 模块管理
    Route::apiResource('z_module', ZModuleController::class)->except(['show']);
    Route::controller(ZModuleController::class)->prefix('z_module')->group(function () {
        Route::get('getMyMenu/{role}', 'getMyMenu');
        Route::get('getSelfLowModules/{role}', 'getSelfLowModules');
        // 根据节点设置树形结构
        Route::post('setModuleTree/{z_module}', 'setModuleTree');
    });

// 角色管理
    Route::apiResource('z_role', ZRoleController::class)->except(['show'])->parameters([
        'z_role' => 'role'
    ]);
    Route::controller(ZRoleController::class)->prefix('z_role')->group(function () {
        // 得到子或等同角色
        Route::get('getSelfOrLowRoles/{role}', 'getSelfOrLowRoles');
    });

// 权限管理
    Route::apiResource('z_permission', ZPermissionController::class)->except(['show'])->parameters([
        'z_permission' => 'permission'
    ]);

// 单位管理
    Route::apiResource('z_unit', ZUnitController::class)->except(['show']);
    Route::controller(ZUnitController::class)->prefix('z_unit')->group(function () {
        Route::get('getUnitTree', 'getUnitTree');
        // 得到指定节点树
        Route::get('getTheUnitTree/{z_unit}', 'getTheUnitTree');
        // 根据节点设置树形结构
        Route::post('setUnitTree/{z_unit}', 'setUnitTree');
    });

// 用户管理
    Route::apiResource('users', UserController::class)->except(['show']);
    Route::controller(UserController::class)->prefix('users')->group(function () {
        Route::post('setMyPassword', 'setMyPassword');
        // 设置用户们的权限
        Route::post('setUsersRoles', 'setUsersRoles');
        // 得到用户所属单位
        Route::get('getUserUnit/{user}', 'getUserUnit');
        // 设置用户所属单位
        Route::post('setUserUnit', 'setUserUnit');
        // 得到用户角色
        Route::get('getUserRoles/{user}', 'getUserRoles');
        // 得到用户所具有的权限配置模板
        Route::post('getUsersPermisstionCfgs', 'getUsersPermisstionCfgs');
        // 设置用户所具有的权限配置模板,返回设置用户数及权限数
        Route::post('setUsersPermissionCfgs', 'setUsersPermissionCfgs');
        // 关注用户
        Route::post('likeTheUser/{user}', 'likeTheUser');
    });

// 用户资料管理
    Route::apiResource('profile', ZUserprofileController::class)->except(['show'])->parameters([
        'profile' => 'z_userprofile'
    ]);
    Route::controller(ZUserprofileController::class)->prefix('profile')->group(function () {
        Route::get('getMyProfile', 'getMyProfile');
        Route::post('updateMyProfile/', 'updateMyProfile');
    });

//// 文章管理
//    Route::apiResource('article', ArticleController::class)->except(['show']);
//    Route::prefix('article')->group(function () {
//        Route::get('getTheArticle/{article}', [ArticleController::class, 'getTheArticle']);
//    });

// 后台总控中心，系统基本功能
    Route::prefix('zero')->group(function () {
        // 请求权限
        //   参数{
        //        role: 'w',
        //        module: 'users1',
        //        name: 'sort',
        //        syscfg: {
        //          mynode: { required: false, type: Number, default: null }
        //        },
        //        title: '调整用户树'
        //      }
        Route::post('reqThePermission', [ZeroController::class, 'reqThePermission']);
        // 得到登录用户权限 参数为 role
        Route::post('getMyPermissions', [ZeroController::class, 'getMyPermissions']);
        // 得到角色模块
        Route::get('getRoleModules/{role}', [ZeroController::class, 'getRoleModules']);
        // 绑定角色模块
        Route::post('setRoleModules/{role}', [ZeroController::class, 'setRoleModules']);
        // 上传我的临时文件
        Route::post('uploadMyTmpFiles', [ZeroController::class, 'uploadMyTmpFiles']);
        // 得到我的临时文件
        Route::get('getMyTmpFiles', [ZeroController::class, 'getMyTmpFiles']);
        // 删除我的临时文件
        Route::post('delMyTmpFiles', [ZeroController::class, 'delMyTmpFiles']);
        // 设置我的用户配置
        Route::post('setMyUsercfg', [ZeroController::class, 'setMyUsercfg']);

        // 向用户发消息
        Route::post('sendMsgToUser/{user}', [ZeroController::class, 'sendMsgToUser']);

    });

});

//不需要认证
Route::controller(XapperrController::class)->prefix('xapperr')->group(function () {
    Route::get('getAllLogs', 'index');
    Route::post('clearLogs', 'clearLogs');
    Route::post('storeLog', 'store');
});

Route::any('wechat', [WeChatController::class, 'serve']);

//微信认证
Route::group(['middleware' => ['easywechat.oauth']], function () {
    Route::get('/wechatuser', function () {
        $user = session('easywechat.oauth_user.default'); // 拿到授权用户资料
        if (env('APP_DEBUG')) {
            \Log::info('Webchat Debug:', ['user info' => $user]);
        }
    });
});


// 数据库调试
//DB::listen(function ($event) {
//    $sExecSql = Str::replaceArray('?', $event->bindings, $event->sql);
//    \Log::info("Sql Debug:", [Str::replace("\"", "", $sExecSql)]);
//});

?>
