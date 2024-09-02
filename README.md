# Sistema de Gerenciamento de Estratégias WMS

O Sistema de Gerenciamento de Estratégias WMS (Warehouse Management System) é uma aplicação desenvolvida em PHP utilizando o framework Laravel 11 e banco de dados PostgreSQL 12+.<br /> 
Este sistema permite a criação, gerenciamento e consulta de estratégias de prioridade dentro de um ambiente de gerenciamento de armazém.

## Funcionalidades Principais

- **Criação de Estratégias**: Permite a criação de estratégias com descrição e prioridade, bem como a definição de horários específicos para essas estratégias.
- **Gestão de Prioridades**: Define e gerencia a prioridade das estratégias em horários específicos, garantindo uma ordem de execução eficiente e organizada.
- **Consultas de Prioridade**: Permite a consulta de prioridade de uma estratégia com base no tipo da estratégia, hora e minuto informados, retornando a prioridade correspondente ou a prioridade padrão se o horário estiver fora dos intervalos definidos.

## Componentes Técnicos

### Migrations

- `tb_estrategia_wms`: Tabela principal para armazenar as estratégias.
- `tb_estrategia_wms_horario_prioridade`: Tabela para armazenar os horários e prioridades das estratégias.

### Rotas
- **POST `/estrategiaWMS`**: Endpoint para criar uma nova estratégia com horários e prioridades.
- **GET `/estrategiaWMS/{cdEstrategia}/{dsHora}/{dsMinuto}/prioridade`**: Endpoint para consultar a prioridade de uma estratégia com base no tipo da estratégia, hora e minuto informados.

### Configuração com Docker
O projeto inclui um arquivo `docker-compose.yml` para facilitar a execução e configuração do ambiente de desenvolvimento com Docker.

### Validação com Postman
Uma coleção do Postman é fornecida para facilitar a validação das funcionalidades do sistema.

### Ferramentas

* PHP 8.0
* Laravel 11
* PostgreSQL 12+
* Docker
* Postman

## Como Funciona

### Cadastro de Estratégias

Os usuários podem cadastrar novas estratégias, especificando a descrição e a prioridade. Além disso, podem definir horários específicos e suas respectivas prioridades para cada estratégia.

### Consulta de Prioridades

Através da rota de consulta, o sistema retorna a prioridade da estratégia com base no tipo da estratégia, hora e minuto informados pelo usuário, garantindo um gerenciamento eficiente das operações do armazém.

### Instalação
Siga os passos abaixo para configurar e executar o projeto em sua máquina local.
### 1. Clonar o Repositório
```
git clone https://github.com/am-matheusoliveira/desafio-back-end-alfa-erp.git
cd desafio-back-end-alfa-erp
```
### 2. Instalar Dependências
```
composer install
```
### 3. Configurar o Arquivo `.env`
Crie um arquivo `.env` a partir do `.env.example` e configure as variáveis de ambiente.</br>
```
cp .env.example .env
```
Edite o arquivo `.env` para incluir suas configurações de banco de dados, use este exemplo já configurado para rodar com Docker:
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
### 4. Criar o Banco de Dados
Ao executar o arquivo `docker-compose.yml` o Banco de Dados será automaticamente criado, e também sera executado o comando `php artisan migrate` para a criação das Tabelas.<br>

### 5. Execute o Docker Compose
Acesse a raiz do projeto e execute:
```
docker-compose up -d
```
### 6. Importar a Collection do Postman
Localize na pasta `/postman-collections` abra o Postman e importe a Collection.<br>
A aplicação estará disponível em:
```
http://localhost:8000
```

### Conclusão

Este projeto demonstra minhas habilidades no desenvolvimento de Rotas e Migrations com PHP e Laravel, incluindo:
* Desenvolvimento de endpoints para criar e buscar registros
* Respostas em formato JSON
* Conteinerização com Docker
* Manipulação de Banco de Dados
* Criação do arquivo `docker-compose.yml`
---
Sinta-se à vontade para explorar o código e fazer melhorias.<br>
Se tiver alguma dúvida, entre em contato.
