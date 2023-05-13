<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActivitiesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

// Criar uma instância do controlador
$activitiesController = new ActivitiesController();

Route::post('/atividades', function (Request $request) use ($activitiesController) {
  // Chamar o método index do controlador para processar a requisição POST
  $data = $activitiesController->index($request);

  // Retornar a view 'api' com os dados
  return view('api')->with('data', $data);
});

// Verificar o método da requisição
$request = Request::createFromGlobals();
if ($request->method() === 'POST') {
  // Chamar o método index do controlador para processar a requisição POST
  $activitiesController->index($request);
} else {
  // Retornar um erro para requisições que não sejam POST
  header('HTTP/1.1 405 Method Not Allowed');
}