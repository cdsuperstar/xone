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

// 解决下载文件的中文名BUG
setlocale(LC_ALL, 'C.UTF-8');

if (env('APP_DEBUG')) {
    \Log::info('API Debug:', ['url' => Request::url(), 'request' => Request::all(), 'method' => Request::method(), 'Client' => Request::getClientIp(), 'isJson' => Request::isJson()]);
}
//Auth::routes();

// 系统基础功能
Route::post('oauth/token', [\Laravel\Passport\Http\Controllers\AccessTokenController::class, 'issueToken']);
//Route::post('oauth/refresh', '\Laravel\Passport\Http\Controllers\TransientTokenController@refresh');
Route::post('auth/logout', [LoginController::class, 'logout']);
Route::get('auth/user', [UserController::class, 'self']);
Route::post('auth/register', [RegisterController::class, 'register']);
Route::post('broadcasting/auth', [\Illuminate\Broadcasting\BroadcastController::class, 'authenticate']);

//需要认证
Route::group(['middleware' => ['auth']], function () {
// 模块管理
    Route::apiResource('z_module', ZModuleController::class)->except(['show']);
    Route::prefix('z_module')->group(function () {
        Route::get('getMyMenu/{role}', [ZModuleController::class, 'getMyMenu']);
        Route::get('getSelfLowModules/{role}', [ZModuleController::class, 'getSelfLowModules']);
        // 根据节点设置树形结构
        Route::post('setModuleTree/{z_module}', [ZModuleController::class, 'setModuleTree']);
    });

// 角色管理
    Route::apiResource('z_role', ZRoleController::class)->except(['show'])->parameters([
        'z_role' => 'role'
    ]);
    Route::prefix('z_role')->group(function () {
        // 得到子或等同角色
        Route::get('getSelfOrLowRoles/{role}', [ZRoleController::class, 'getSelfOrLowRoles']);
    });

// 权限管理
    Route::apiResource('z_permission', ZPermissionController::class)->except(['show'])->parameters([
        'z_permission' => 'permission'
    ]);

// 单位管理
    Route::apiResource('z_unit', ZUnitController::class)->except(['show']);
    Route::prefix('z_unit')->group(function () {
        Route::get('getUnitTree', [ZUnitController::class, 'getUnitTree']);
        // 得到指定节点树
        Route::get('getTheUnitTree/{z_unit}', [ZUnitController::class, 'getTheUnitTree']);
        // 根据节点设置树形结构
        Route::post('setUnitTree/{z_unit}', [ZUnitController::class, 'setUnitTree']);
    });

// 用户管理
    Route::apiResource('users', UserController::class)->except(['show']);
    Route::prefix('users')->group(function () {
        Route::post('setMyPassword', [UserController::class, 'setMyPassword']);
        // 设置用户们的权限
        Route::post('setUsersRoles', [UserController::class, 'setUsersRoles']);
        // 得到用户所属单位
        Route::get('getUserUnit/{user}', [UserController::class, 'getUserUnit']);
        // 设置用户所属单位
        Route::post('setUserUnit', [UserController::class, 'setUserUnit']);
        // 得到用户角色
        Route::get('getUserRoles/{user}', [UserController::class, 'getUserRoles']);
        // 得到用户所具有的权限配置模板
        Route::post('getUsersPermisstionCfgs', [UserController::class, 'getUsersPermisstionCfgs']);
        // 设置用户所具有的权限配置模板,返回设置用户数及权限数
        Route::post('setUsersPermissionCfgs', [UserController::class, 'setUsersPermissionCfgs']);
    });

// 用户资料管理
    Route::apiResource('profile', ZUserprofileController::class)->except(['show'])->parameters([
        'profile' => 'z_userprofile'
    ]);
    Route::prefix('profile')->group(function () {
        Route::get('getMyProfile', [ZUserprofileController::class, 'getMyProfile']);
        Route::post('updateMyProfile/', [ZUserprofileController::class, 'updateMyProfile']);
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
        // 设置我的用户配置
        Route::post('setMyUsercfg', [ZeroController::class, 'setMyUsercfg']);
    });

//    // 项目1 贵阳物探所
//    Route::prefix('p1')->group(function () {
//        Route::prefix('s1')->group(function () {
//            Route::apiResource('p1s1techfile', 'P1s1techfileController')->except(['show']);
//            Route::prefix('p1s1techfile')->group(function () {
//                Route::post('downAttachFile/{p1s1techfile}', 'P1s1techfileController@downAttachFile');
//                Route::post('deleteAttachFile/{p1s1techfile}', 'P1s1techfileController@deleteAttachFile');
//            });
//
//            Route::apiResource('p1s1bidfile', 'P1s1bidfileController')->except(['show']);
//            Route::apiResource('p1s1contrm', 'P1s1contrmController')->except(['show']);
//            Route::apiResource('p1s1outsc', 'P1s1outscController')->except(['show']);
//            Route::apiResource('p1s1proji', 'P1s1projiController')->except(['show']);
//            Route::apiResource('p1s1projm', 'P1s1projmController')->except(['show']);
//        });
//    });

//项目2 在线调查问卷
//    Route::prefix('p2')->group(function () {
//        Route::prefix('s1')->group(function () {
//            Route::apiResource('p2s1questionnaire1', 'P2s1questionnaire1Controller')->except(['show']);
//            Route::prefix('p2s1questionnaire1')->group(function () {
//                // 统计问卷数量
//                Route::post('onqt', 'P2s1questionnaire1Controller@countqt');
//                // 得到个人问卷管理
//                Route::get('getMyQ', 'P2s1questionnaire1Controller@MyQ');
//
//                Route::post('downAttachFile/{p2s1questionnaire1}', 'P2s1questionnaire1Controller@downAttachFile');
//                Route::post('deleteAttachFile/{p2s1questionnaire1}', 'P2s1questionnaire1Controller@deleteAttachFile');
//            });
//
//        });
//    });
//
//    //项目3 交通检测系统 p3
//    Route::prefix('p3')->group(function () {
//        Route::prefix('s1')->group(function () {
//
//            // 模型管理
//            Route::apiResource('p3s1mod', 'P3s1modController')->except(['show']);
//            Route::prefix('p3s1mod')->group(function () {
//                Route::get('getTheUsers', 'P3s1modController@getTheUsers');
//                Route::post('setUserMods/{user}', 'P3s1modController@setUserMods');
//                Route::post('getUsermods/{user}', 'P3s1modController@getUsermods');
//            });
//
//            // 设备参数
//            Route::apiResource('p3s1device', 'P3s1deviceController')->except(['show']);
//            Route::prefix('p3s1device')->group(function () {
//                Route::post('downAttachFile/{p3s1device}', 'P3s1deviceController@downAttachFile');
//                Route::post('deleteAttachFile/{p3s1device}', 'P3s1deviceController@deleteAttachFile');
//            });
//
//            // 项目数据
//            Route::apiResource('p3s1projectdata', P3s1projectdataController::class)->except(['show', 'destroy', 'update']);
//            Route::prefix('p3s1projectdata')->group(function () {
//                // fix data -> datum bug
//                Route::delete('{p3s1projectdata}', 'P3s1projectdataController@destroy');
//                Route::put('{p3s1projectdata}', 'P3s1projectdataController@update');
//
//                // 得到具体项目的数据
//                Route::get('getByProj/{p3s1project}', 'P3s1projectdataController@getByProj');
//                // 得到模型
//                Route::get('getmodels', 'P3s1projectdataController@getModels');
//                // 展开至检测数据表
//                Route::post('unziptodb/{p3s1projectdata}', 'P3s1projectdataController@unziptodb');
//                // 得到统计
//                Route::post('getStatistics', 'P3s1projectdataController@getStatistics');
//                // 导出好的检测结果包
//                Route::post('getDetectedZip/{p3s1projectdata}', 'P3s1projectdataController@getDetectedZip');
//                // 导出Excel报表
//                Route::post('getExcel', 'P3s1projectdataController@getExcel');
//                // 删除展开数据
//                Route::delete('delziped/{p3s1projectdata}', 'P3s1projectdataController@delziped');
//                // 开始检测
//                Route::post('odetect/{p3s1projectdata}', 'P3s1projectdataController@odetect');
//                // 下载附件
//                Route::post('downAttachFile/{p3s1projectdata}', 'P3s1projectdataController@downAttachFile');
//                // 删除附件
//                Route::post('deleteAttachFile/{p3s1projectdata}', 'P3s1projectdataController@deleteAttachFile');
//            });
//
//            // 检测数据
//            Route::apiResource('p3s1checkeddata', P3s1checkeddataController::class)->except(['show', 'destroy', 'update']);
//            Route::prefix('p3s1checkeddata')->group(function () {
//                // fix data -> datum bug
//                Route::delete('{p3s1checkeddata}', 'P3s1checkeddataController@destroy');
//                Route::put('{p3s1checkeddata}', 'P3s1checkeddataController@update');
//                // 得到图片url
//                Route::get('getUrl/{p3s1checkeddata}', 'P3s1checkeddataController@getUrl');
//                // 得到阀值 每图片一个阀值
////                Route::get('getThreshold', 'P3s1checkeddataController@getThreshold');
//                // 得到data对应check data
//                Route::get('byData/{p3s1projectdata}', 'P3s1checkeddataController@byData');
//                // 打包好的标记结果包
//                Route::post('getLabeledZip/{p3s1checkeddata}', 'P3s1checkeddataController@getLabeledZip');
//
//                Route::post('downAttachFile/{p3s1checkeddata}', 'P3s1checkeddataController@downAttachFile');
//                Route::post('deleteAttachFile/{p3s1checkeddata}', 'P3s1checkeddataController@deleteAttachFile');
//            });
//
//            // 项目库
//            Route::apiResource('p3s1project', 'P3s1projectController')->except(['show']);
//            Route::prefix('p3s1checkeddata')->group(function () {
//            });
//        });
//    });
//});
//
////不需要认证
//
//项目2 在线调查问卷
//Route::prefix('p2')->group(function () {
//    Route::prefix('s1')->group(function () {
////        Route::apiResource('p2s1questionnaire1', 'P2s1questionnaire1Controller')->except(['show']);
//        Route::prefix('p2s1questionnaire1')->group(function () {
//            Route::post('noa', 'P2s1questionnaire1Controller@store');
////            Route::post('downAttachFile/{p2s1questionnaire1}', 'P2s1questionnaire1Controller@downAttachFile');
////            Route::post('deleteAttachFile/{p2s1questionnaire1}', 'P2s1questionnaire1Controller@deleteAttachFile');
//        });
//
//    });
//});

// 数据库调试
//DB::listen(function ($event) {
//    Log::info($event->sql);
//    Log::info($event->bindings);
//});
});

?>
