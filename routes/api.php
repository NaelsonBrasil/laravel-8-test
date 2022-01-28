<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\PeoplesController;
use App\Models\People;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::prefix('v1')->group(function () {

  Route::post('register', [RegisterController::class, 'register']);
  Route::post('login', [RegisterController::class, 'login']);

  #Route::resource('peoples', People::class);

  Route::middleware('token_auth', 'throttle:10000000,1')->group(function () {
    Route::post('test', [TestController::class, 'index']);
    Route::post('create', [PeoplesController::class, 'store']);
    Route::get('selectAll', [PeoplesController::class, 'all']);
    Route::post('selectBy', [PeoplesController::class, 'one']);
    Route::post('deleteAll', [PeoplesController::class, 'deleteAll']);
    Route::post('update', [PeoplesController::class, 'update']);

    Route::get('sAllCurrency', function () {
      $res = Http::get('https://economia.awesomeapi.com.br/json/all');
      return $res->json();
    });

    Route::post('convert', function (Request $request) {

      $input = $request->all();
      $valueBought = $input['price'];

      $type = $input['product_cur']['type'];
      $bid = $input['product_cur']['bid'];

      $rateVal = $input['md_payment']['val'];
      $mhdType = $input['md_payment']['type'];

      $val_disMd = $valueBought * $rateVal / 100;

      $valMhdDiscont = $valueBought - $val_disMd;

      $val_disUpDown = 0;
      if ($val_disMd < 3000.00) {
        $val_disUpDown = $valueBought * 1 / 100;
      } else  if ($val_disMd > 3000.00) {
        $val_disUpDown = $valueBought * 2 / 100;
      }

      /*

      Aplicar taxa de 2% pela conversão para valores abaixo de R$ 3.000,00 e 1% para valores maiores que R$ 3.000,00, 
      essa taxa deve ser aplicada apenas no valor da compra e não sobre o valor já com a taxa de forma de pagamento.
      */
      $unknow = $valueBought - $val_disUpDown;

      return response()->json([
        'cur_origim' => 'BRL',
        'cur_destiny' => $type,
        'val_input' => $valueBought,
        'mhd_payment' => $mhdType,
        'val_cur_destiny' => $bid,
        'val_buy' => $unknow,
        'rate_payment' => $val_disMd, //Taxa de pagamento: R$ 72,50
        'rate_conversion' => $val_disUpDown, //Taxa de conversão: R$ 50,00
        'discont_onversion' => $valMhdDiscont, //Valor utilizado para conversão descontando as taxas: R$ 4.877,50
      ]);
    });
  });
});
