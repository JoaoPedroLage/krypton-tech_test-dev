<?php

use Illuminate\Http\Request;

class ActivitiesController
{
  public function index(Request $request)
  {
    header('Content-Type: application/json');
    // Dados das atividades em formato JSON
    $jsonData = '[
            {
                "atividade": "tomar café da manhã",
                "hora": "06:30"
            },
            {
                "atividade": "correr",
                "hora": "06:45"
            },
            {
                "atividade": "tomar banho",
                "hora": "07:15"
            },
            {
                "atividade": "transito",
                "hora": "07:40"
            },
            {
                "atividade": "ler emails",
                "hora": "08:15"
            },
            {
                "atividade": "ir para cada dos avós",
                "hora": "09:00"
            },
            {
                "atividade": "almoço em família",
                "hora": "12:00"
            },
            {
                "atividade": "ver filme em casa",
                "hora": "14:00"
            },
            {
                "atividade": "tomar banho",
                "hora": "17:00"
            },
            {
                "atividade": "arrumar para aniversario",
                "hora": "17:20"
            },
            {
                "atividade": "transito",
                "hora": "17:45"
            },
            {
                "atividade": "comemoração do aniversario",
                "hora": "18:30"
            },
            {
                "atividade": "transito",
                "hora": "21:30"
            },
            {
                "atividade": "ligar video game",
                "hora": "22:00"
            },
            {
                "atividade": "descansar",
                "hora": "23:00"
            }
        ]';

    // Decodificar o JSON em um array associativo
    $data = json_decode($jsonData, true);

    // Ordenar os dados por hora
    usort($data, function ($a, $b) {
      return strtotime($a['hora']) - strtotime($b['hora']);
    });

    // Parâmetros da requisição
    $page = $request->input('page', 1);
    $perPage = 5;

    // Calcular o índice de início e fim dos dados para a página solicitada
    $start = ($page - 1) * $perPage;
    $end = $start + $perPage;

    // Obter os dados da página solicitada
    $pagedData = array_slice($data, $start, $perPage);

    // Construir a resposta em formato JSON
    $response = [
      'page' => $page,
      'perPage' => $perPage,
      'totalPages' => ceil(count($data) / $perPage),
      'data' => $pagedData
    ];

    // Enviar a resposta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);

    // Construir a resposta em formato JSON
    $response = [
      'page' => $page,
      'perPage' => $perPage,
      'totalPages' => ceil(count($data) / $perPage),
      'data' => $pagedData
    ];

    // Retornar a view 'api' com os dados
    return view('api')->with('data', $response);
  }
}