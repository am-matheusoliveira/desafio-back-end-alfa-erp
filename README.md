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

### 3. Mudanças no arquivo `server.php`, execute os passos a seguir para alterar este arquivo
O motivo de alterar este arquivo é devido ao fato de a aplicação ter tido o seu arquivo `index.php` da pasta `/public` movido para a raiz da aplicação.<br />
Com isso, a URL não terá o nome **public** aparente para o usuário, proporcionando uma aparência mais profissional e também evitando erros de execução ao iniciar a aplicação com o servidor interno do Laravel.

Execute os comandos abaixo de acordo com o seu Sistema Operacional.<br />
Windows - Copiar o conteúdo de um arquivo para outro e, em seguida, excluí-los.
```
php anotacoes\alterar_conteudo.php vendor\laravel\framework\src\Illuminate\Foundation\resources\server.php anotacoes\new-server.php
del anotacoes\new-server.php, anotacoes\alterar_conteudo.php
```
Linux - Copiar o conteúdo de um arquivo para outro e, em seguida, excluí-los.
```
php anotacoes\alterar_conteudo.php vendor\laravel\framework\src\Illuminate\Foundation\resources\server.php anotacoes\new-server.php
rm anotacoes\new-server.php anotacoes\alterar_conteudo.php
```

### 4. Configurar o Arquivo `.env`
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
```
### 5. Criar o Banco de Dados
Ao executar o arquivo `docker-compose.yml` o Banco de Dados será automaticamente criado, e também sera executado o comando `php artisan migrate` para a criação das tabelas do sistema.<br>

### 6. Execute o Docker Compose
Na raiz do projeto execute o comando:
```
docker-compose up -d
```
Esse comando cria as imagens e inicia os contêineres da aplicação e do banco de dados e inicia o Servidor Web Interno do Laravel. A aplicação estará disponível em:
```
http://localhost:8000
```

### 7. Importar a Collection do Postman
Localize na pasta `/postman-collections` abra o Postman e importe a Collection.<br>
Todas as rotas da aplicação já estarão disponíveis para uso em:
```
http://localhost:8000
```

### Referências

- **PHP 8.0**  
  [documentação oficial do PHP 8.0](https://www.php.net/releases/8.0/).

- **Laravel 11**  
  [documentação oficial do Laravel](https://laravel.com/docs).

- **PostgreSQL**  
  [documentação oficial do PostgreSQL](https://www.postgresql.org/docs/).

- **Docker**  
  [documentação oficial do Docker](https://docs.docker.com/).

- **Postman**  
  [documentação oficial do Postman](https://learning.postman.com/docs/getting-started/introduction/).

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
