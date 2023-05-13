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
    body {
      font-family: 'figtree', sans-serif;
      background-color: #f8f8f8;
      color: #333;
      margin: 0;
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    h1 {
      margin-top: 0;
      text-align: center;
      background-color: #D3D3D3;
      height: 50px;
    }

    h2 {
      margin-top: 30px;
      text-align: center;
    }

    form {
      margin-bottom: 30px;
      display: flex;
      justify-content: space-around;
      border: 1px solid;
      height: 350px;
      width: 800px;
      align-self: center;
    }

    form div {
      margin-bottom: 30px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      margin-left: 50px;
    }

    form label {
      display: block;
      margin-bottom: 5px;
    }

    form input[type="text"] {
      width: 100%;
      padding: 10px;
      font-size: 12px;
      border: 1px solid #ccc;
      border-radius: 5px;
      margin-bottom: 5px;
    }

    button[type="submit"] {
      padding: 10px 20px;
      background-color: #333;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 12px;
      cursor: pointer;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ccc;
    }

    th {
      background-color: #f2f2f2;
      font-weight: bold;
    }

    tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    button {
      padding: 5px 10px;
      background-color: #e74c3c;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 12px;
      cursor: pointer;
      height: 40px;
      margin-left: 50px;
      align-self: end;
    }
  </style>
</head>

<body class="antialiased">

  <h1>Listagem de Carros</h1>

  <h2>Adicionar novo carro</h2>

  <form id="newCarForm">
    <div>
      <h3>Carro:</h3>
      <label for="marca">Marca:</label>
      <input type="text" name="marca" id="marca" required>
      
      <label for="modelo">Modelo:</label>
      <input type="text" name="modelo" id="modelo" required>
      
      <label for="cor">Cor:</label>
      <input type="text" name="cor" id="cor" required>
      
    </div>
    <div>
      <h3>Motor:</h3>
      <label for="posicionamento">Posicionamento Cilindros:</label>
      <input type="text" name="posicionamento" id="posicionamento" required>
      
      <label for="cilindros">Cilindros:</label>
      <input type="text" name="cilindros" id="cilindros" required>
      
      <label for="litragem">Litragem:</label>
      <input type="text" name="litragem" id="litragem" required>
      
      <label for="observacao">Observacao:</label>
      <input type="text" name="observacao" id="observacao">
      
    </div>
    <button type="submit">Inserir</button>
  </form>

  <table id="carsList">
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
    <tbody></tbody>
  </table>

  <script>
    // Função para gerar um ID único
    function generateId() {
      // Obtem a lista de carros do LocalStorage
      const cars = JSON.parse(localStorage.getItem('carros')) || [];

      // Verifica se há carros na lista
      if (cars.length > 0) {
        // Obtem o último ID do array cars
        const lastCar = cars[cars.length - 1];

        // Extrai o número do último ID e adicione 1
        const lastId = parseInt(lastCar.id);
        const newId = lastId + 1;

        // Retorna o novo ID como uma string
        return newId;
      } else {
        // Se não houver carros, retorne um ID padrão
        return '1';
      }
    }

    // Função para excluir um carro
    function deleteCar(carId) {
      // Obter a lista de carros do LocalStorage
      const cars = JSON.parse(localStorage.getItem('carros')) || [];

      // Encontrar o índice do carro a ser excluído
      const index = cars.findIndex(car => Number(car.id) === Number(carId));

      // Remover o carro da lista
      if (index !== -1) {
        cars.splice(index, 1);
      }

      // Atualizar a lista de carros no LocalStorage
      localStorage.setItem('carros', JSON.stringify(cars));
      // Atualizar a lista de carros na interface
      updateListCars(cars);
    }

    // Função para atualizar a lista de carros na interface
    function updateListCars(data, first_time = false) {
      const carsList = document.getElementById('carsList');
      const tbody = carsList.querySelector('tbody');
      tbody.innerHTML = '';
      console.log(first_time);
      console.log(data);

      if(first_time) {
        data.carros.forEach(car => {
          // Procurar o motor do carro pelo ID
          let motor = null;
          data.motores.forEach(engine => {
            if (engine.id === car.motor_id) {
              motor = engine;
              return;
            }
          });

          // Adicionar a chave "motor" ao objeto "car"
          if (motor.observacao !== null) {
          car.motor = `${motor.observacao}, ${motor.cilindros} Cilindros em ${motor.posicionamento_cilindros}, ${motor.litragem} Litros`;
          } else {
          car.motor = `${motor.cilindros} Cilindros em ${motor.posicionamento_cilindros}, ${motor.litragem} Litros`;
          }

          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td>${car.id}</td>
            <td>${car.marca}</td>
            <td>${car.modelo}</td>
            <td>${car.cor}</td>
            <td>${car.motor}</td>
            <td>
              <button onclick="deleteCar('${car.id}')">Excluir</button>
            </td>
          `;
          tbody.appendChild(tr);

          localStorage.setItem('carros', JSON.stringify(data.carros));

        });
      } else {
          data.forEach(car => {
          const tr = document.createElement('tr');
          tr.innerHTML = `
            <td>${car.id}</td>
            <td>${car.marca}</td>
            <td>${car.modelo}</td>
            <td>${car.cor}</td>
            <td>${car.motor}</td>
            <td>
              <button onclick="deleteCar('${car.id}')">Excluir</button>
            </td>
          `;
          tbody.appendChild(tr);
        });
      }
    }

    // Função para adicionar um novo carro
    function addCar(event) {
      event.preventDefault();

      const form = event.target;
      const marca = form.marca.value;
      const modelo = form.modelo.value;
      const cor = form.cor.value;
      const posicionamento = form.posicionamento.value;
      const cilindros = form.cilindros.value;
      const litragem = form.litragem.value;
      const observacao = form.observacao.value;

      // Obter a lista de carros do LocalStorage
      let cars = JSON.parse(localStorage.getItem('carros')) || [];

      // Criar o novo objeto de carro
      const newCar = {
        id: generateId(),
        marca,
        modelo,
        cor,
        motor: `${cilindros} Cilindros em ${posicionamento}, ${litragem} Litros`,
        observacao,
      };

      // Adicionar o novo carro à lista de carros
      cars.push(newCar);

      // Atualizar a lista de carros no LocalStorage
      localStorage.setItem('carros', JSON.stringify(cars));

      // Atualizar a lista de carros na interface
      updateListCars(cars);

      // Limpar os campos do formulário
      form.reset();
    }

    // Event listener para o formulário de adicionar carro
    const newCarForm = document.getElementById('newCarForm');
    newCarForm.addEventListener('submit', addCar);

    // Obtém a lista de carros do LocalStorage
    const cars = JSON.parse(localStorage.getItem('carros'));

    // Atualiza a lista de carros na interface
    cars && updateListCars(cars);

    // Faz a requisição GET ao endpoint para popular a lista inicial
    <?php 
        // Faz a requisição GET ao endpoint
        function obterDados() {
          $endpoint = 'http://apiintranet.kryptonbpo.com.br/test-dev/exercise-1';
          $response = file_get_contents($endpoint);
          $data = json_decode($response, true);

          return  $data;
        }
        $dadosJSON = json_encode(obterDados());
    ?>

    const data = JSON.parse('<?php echo $dadosJSON; ?>');

    if (data && Array.isArray(data.carros)) {
      // Atualiza a lista de carros no LocalStorage
      localStorage.setItem('carros', JSON.stringify(data.carros));
      // Atualiza a lista de carros na interface
      updateListCars(data, true);
    } else {
      console.log('Erro ao obter a lista de carros.');
    }
  </script>
</body>

</html>
