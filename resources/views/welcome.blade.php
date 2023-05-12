<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Listagem de Carros</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

  <!-- Styles -->
  <style>

  </style>
</head>

<body class="antialiased">

  <h1>Listagem de Carros</h1>

  <h2>Adicionar novo carro</h2>

  <form method="POST" action="create_car.php">
    <h3>Carro:</h3>
    <label for="name">Marca:</label>
    <input type="text" name="name" id="name" required>
    <br>
    <label for="name">Modelo:</label>
    <input type="text" name="name" id="name" required>
    <br>
    <label for="name">Cor:</label>
    <input type="text" name="name" id="name" required>
    <br>
    <h3>Motor:</h3>
    <label for="name">Posicionamento Cilindros:</label>
    <input type="text" name="name" id="name" required>
    <br>
    <label for="name">Cilindros:</label>
    <input type="text" name="name" id="name" required>
    <br>
    <label for="name">Litragem:</label>
    <input type="text" name="name" id="name" required>
    <br>
    <label for="name">Observacao:</label>
    <input type="text" name="name" id="name" required>
    <br>
    <input type="submit" value="Inserir">
  </form>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Cor</th>
        <th>Motor</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php 
        // Faz a requisição GET ao endpoint
        $endpoint = 'http://apiintranet.kryptonbpo.com.br/test-dev/exercise-1';
        $response = file_get_contents($endpoint);
        $data = json_decode($response, true);

        // Verifica se a requisição obteve sucesso
        if ($data) {
          // Define o caminho do diretório e do arquivo
          $directoryPath = '../../database/JSON/';
          $filePath = $directoryPath . 'cars.json';

          // Verifica se o diretório existe, caso contrário, cria o diretório
          if (!is_dir($directoryPath)) {
            mkdir($directoryPath, 0777, true);
          }
          // Define o caminho do arquivo
          $filePath = '../../database/JSON/cars.json';

          // Verifica se o arquivo já existe
          if (!file_exists($filePath)) {
            // Cria o arquivo JSON
            $jsonString = json_encode($data);

            // Salva o conteúdo no arquivo
            file_put_contents($filePath, $jsonString);

            echo "<script>console.log('Arquivo JSON criado com sucesso.');</script>";
          } else {
            echo "<script>console.log('O arquivo já existe.');</script>";
          }
        } else {
          echo "<script>console.log('Erro ao obter os dados.');</script>";
        }
      ?>
      <?php
        // Verifica se a requisição obteve sucesso
        if ($data) {
            // Verifica se há carros retornados
            if (count($data['carros']) > 0) {
                echo '<h2>' . 'Os seguintes carros foram encontrados:' . '</h2>';
            } else {
                echo '<h2>' . 'Nenhum carro encontrado.' . '</h2>';
            }
        } else {
            echo '<h2>' . 'Erro ao obter a lista de carros.' . '</h2>';
        }
      ?>
      <?php 
            foreach ($data['carros'] as $car):
            // Procurar o motor do carro pelo ID
            $motor = null;
            foreach ($data['motores'] as $engine) {
              if ($engine['id'] === $car['motor_id']) {
                  $motor = $engine;
                  break;
              }
            }
      ?>
      <tr>
        <td><?php echo $car['id']; ?></td>
        <td><?php echo $car['marca']; ?></td>
        <td><?php echo $car['modelo']; ?></td>
        <td><?php echo $car['cor']; ?></td>
        <td>
          <?php echo $motor ? $motor['cilindros'] . ' Cilindros' . ' em ' . $motor['posicionamento_cilindros'] . ', ' . $motor['litragem'] . ' Litros ' : 'Não encontrado'; ?>
        </td>
        <td>
          <form method="POST" action="/">
            @csrf
            <input type="hidden" name="carId" value="<?php echo $car['id']; ?>">
            <input type="hidden" name="data" value="{{ json_encode($data) }}">
            <button onclick="excluirCarro('${carro.id}')">Excluir</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>

</html>