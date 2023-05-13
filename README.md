<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# :package: Krypton BPO (tech) - Test Dev
por João Lage

<p align="center">
   <img src="http://img.shields.io/static/v1?label=STATUS&message=EM%20DESENVOLVIMENTO&color=RED&style=for-the-badge"/>
</p>

### Tópicos

- [Descrição do projeto](#books-descrição-do-projeto)

- [Stacks utilizadas](#books-stacks-utilizadas)

- [Etapa mais desafiadora](#%EF%B8%8F-etapa-mais-desafiadora)

- [Abrir e rodar o projeto](#%EF%B8%8F-abrir-e-rodar-o-projeto)

- [Feedback](#%EF%B8%8F-feedback)



# :books: Descrição do Projeto

O projeto tem 2 tarefas requeridas:

Tarefa 1
Você deverá consumir o endpoint GET http://apiintranet.kryptonbpo.com.br/test-dev/exercise-1 da nossa API e construir a tela da listagem do carro com seu respectivo motor, a tela para inserir um novo carro com o seu motor e a exclusão do carro com o seu motor. O retorno é um JSON com os dados de carros e de motores que está vinculado pelo motor_id.

* A Tela de listagem estará disponínel na rota padão na porta 'http://localhost/' ou 'http://127.0.0.1/' da sua máquina. Fora a tela de listagem na rota padrão, há a rota '/test' onde eu tentei construir a tela de listagem utilizando apenas PHP puro, sem o auxílio do JavaScript.

Tarefa 2
Criar uma API que será consultado utilizando method POST e que retorne em formato json os dados das atividades ordenado por hora.
O retorno deverá estar paginada e exibir até 5 registros por página e permitir ao desenvolvedor que for consumir a sua API escolher qual página ele irá exibir.

* A API que retorna em formato json os dados das atividades ordenado por hora estará disponínel na rota '/atividades' na porta 'http://localhost/' ou 'http://127.0.0.1/' da sua máquina.
* Para acessá-la você deve fazer uma requisição do tipo POST (requisição do tipo GET não são aceitas) e enviar ou nos parâmetros da requisição ou enviar um json no body da requisição com a chave 'page' e o valor da página desejada, exemplo:
![image](https://github.com/JoaoPedroLage/krypton-tech_test-dev/assets/87338925/9ea5f3e4-fbe2-43e4-a752-a614da782b43)
![image](https://github.com/JoaoPedroLage/krypton-tech_test-dev/assets/87338925/d8160206-06bd-4383-8e51-985f0897b34e)


# :books: Stacks utilizadas

- [PHP](https://www.php.net/)
- [JavaScript](https://www.w3schools.com/js/)
- [Laravel](https://laravel.com/)


# Etapa mais desafiadora

- Já possuia alguma familiaridade com PHP mas nunca tinha construído uma aplicação desse tipo, foi um grande desafio aprender tudo o que era necessário para construir as views, as rotas e usar controllers do sistema Laravel.
- Garantir que todas as funções estão se comunicando com coerência e gerando os resultados esperados.


# 🛠️ Abrir e rodar o projeto

1. Clone o repositório
  * `git clone git@github.com:JoaoPedroLage/ABAS---TEST-DEV-FRONTEND.git`
  * Entre na pasta do repositório que você acabou de clonar

2. Instale as dependências e inicialize
  * Instale as dependências:
    * `composer install`
  * Rode os seguintes comadandos:
    * `copy .env.example .env` e `php artisan key:generate`
  * Inicialize o projeto:
   * `php artisan serve`


#Feedback

* Achei estranho a escolha do método POST para retornar um json com as atividades ordenadas, semanticamente falando não seria mais correto o uso do método GET para o retorno do json, já que o uso do método POST geralmente é destinado a inserir novos dados e do GET de apenas retorná-los.
* Tentei utilizar o axios e o fetch do JavaScript para fazer a requisição a api da listagem de carros, porém obtive erros de bloqueio da requisição e de cors.
