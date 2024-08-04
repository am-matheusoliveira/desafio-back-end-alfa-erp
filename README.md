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
- **GET `/estrategiaWMS/{cdEstrategia}/{dsHora}/{dsMinuto}/prioridade`**: Endpoint para consultar a prioridade de uma estratégia com base no horário.

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

Através da rota de consulta, o sistema retorna a prioridade da estratégia com base no horário informado pelo usuário, garantindo um gerenciamento eficiente das operações do armazém.

## Como Executar o Projeto

### Pré-requisitos

- Docker
- Docker Compose

### Passos para Executar

1. Clone o repositório:
   ```bash
   git clone <url-do-repositorio>
   ```
