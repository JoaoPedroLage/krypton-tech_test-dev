<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CarController extends Controller
{
  public function delete(Request $request)
  {
    $carId = $request->input('carId');
    $data = json_decode($request->input('data'), true);

    // Procurar o carro pelo ID e remover da variável $data
    $carIndex = null;
    foreach ($data['carros'] as $index => $car) {
        if ($car['id'] === $carId) {
            $carIndex = $index;
            break;
        }
    }
    
    // Remover o carro se encontrado
    if ($carIndex !== null) {
        unset($data['carros'][$carIndex]);
    }
    
    // Retornar uma resposta em JSON indicando o sucesso da exclusão
    $response = ['success' => true, 'message' => 'Carro excluido com sucesso'];
    return response()->json($response);
  }
}