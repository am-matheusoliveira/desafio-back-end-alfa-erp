# Sistema de Gerenciamento de Estratégias WMS

## Descrição do Projeto

O Sistema de Gerenciamento de Estratégias WMS (Warehouse Management System) é uma aplicação desenvolvida em PHP utilizando o framework Laravel 10 e banco de dados PostgreSQL 12+. Este sistema permite a criação, gerenciamento e consulta de estratégias de prioridade dentro de um ambiente de gerenciamento de armazém.

## Funcionalidades Principais

- **Criação de Estratégias**: Permite a criação de estratégias com descrição e prioridade, bem como a definição de horários específicos para essas estratégias.
- **Gestão de Prioridades**: Define e gerencia a prioridade das estratégias em horários específicos, garantindo uma ordem de execução eficiente e organizada.
- **Consultas de Prioridade**: Permite a consulta da prioridade de uma estratégia com base na hora e minuto informados, retornando a prioridade correspondente ou a prioridade padrão se o horário estiver fora dos intervalos definidos.

## Componentes Técnicos

### Migrations

- `tb_estrategia_wms`: Tabela principal para armazenar as estratégias.
- `tb_estrategia_wms_horario_prioridade`: Tabela para armazenar os horários e prioridades das estratégias.

### Rotas

- **POST `/estrategiaWMS`**: Endpoint para criar uma nova estratégia com horários e prioridades.
- **GET `/estrategiaWMS/{cdEstrategia}/{dsHora}/{dsMinuto}/prioridade`**: Endpoint para consultar a prioridade de uma estratégia com base no tipo da estratégia e horário.

### Configuração com Docker

O projeto inclui um arquivo `docker-compose.yml` para facilitar a execução e configuração do ambiente de desenvolvimento com Docker.

### Validação com Postman

Uma coleção do Postman é fornecida para facilitar a validação das funcionalidades do sistema.

## Tecnologias Utilizadas

- **Linguagem de Programação**: PHP
- **Framework**: Laravel 10
- **Banco de Dados**: PostgreSQL 12+
- **Containerização**: Docker
- **Ferramenta de Teste de API**: Postman

## Como Funciona

### Cadastro de Estratégias

Os usuários podem cadastrar novas estratégias, especificando a descrição e a prioridade. Além disso, podem definir horários específicos e suas respectivas prioridades para cada estratégia.

### Consulta de Prioridades

Através da rota de consulta, o sistema retorna a prioridade da estratégia com base no tipo da estratégia e horário informado pelo usuário, garantindo um gerenciamento eficiente das operações do armazém.

### Como Executar o Projeto
Siga os passos abaixo para configurar e executar o projeto em sua máquina local.
### 1. Clonar o Repositório
```
git clone <URL_DO_REPOSITORIO>
cd <NOME_DO_REPOSITORIO>
```
### 2. Instalar Dependências
```
composer install
```
### 3. Configurar o Arquivo `.env`
Renomeie o arquivo `.env.example` para `.env` e configure as variáveis de ambiente, especialmente as relacionadas ao banco de dados.
```
cp .env.example .env
```
Edite o arquivo `.env` para incluir suas configurações de banco de dados.<br>
Aqui está um exemplo já configurado para rodar com Docker:
```
# PostreSQL
DB_CONNECTION=pgsql
DB_HOST=my-postgres
DB_PORT=5432
DB_DATABASE=estrategia_wms
DB_USERNAME=postgres
DB_PASSWORD=postgres
DB_TIMEZONE='America/Sao_Paulo'
```
### 4. Criar o Banco de Dados:
Ao executar o arquivo `docker-compose.yml` o Banco de Dados será automaticamente criado, e também sera executado o comando `php artisan migrate` para a criação das Tabelas.<br>

### 5. Execute o Docker Compose:
Acesse a raiz do projeto e execute:
```
docker-compose up -d
```
### 6. Importar a Collection do Postman:
Localize na pasta `/postman-collections` abra o Postman e importe a Collection.<br>
A aplicação estará disponível em:.
```
http://localhost:8000
```
