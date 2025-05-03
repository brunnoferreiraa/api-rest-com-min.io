# 📌 Projeto API REST com Laravel

## 📖 Descrição

Este projeto é uma API REST desenvolvida com **Laravel** e banco de dados **PostgreSQL**. A API gerencia servidores efetivos e temporários, unidades, lotações e endereços funcionais. Inclui autenticação com **Laravel Sanctum** e upload de arquivos com **MinIO**.

---

## 🚀 Tecnologias Utilizadas

- **Laravel** (Framework PHP)
- **PostgreSQL** (Banco de dados relacional)
- **MinIO** (Armazenamento de arquivos)
- **Sanctum** (Autenticação por Token)
- **CORS** (Restrições de acesso)
- **Paginação** para todas as consultas

---

## 📌 Requisitos

Antes de iniciar, certifique-se de ter os seguintes itens instalados:

- PHP 8+
- Composer
- PostgreSQL
- MinIO

---

## ⚙️ Instalação

Clone o repositório e instale as dependências:

```bash
git clone https://github.com/api-rest-com-min.io.git
cd api-rest-com-min.io
composer install
```

Gere a chave da aplicação:

```bash
php artisan key:generate
```

---

## 🎲 Configuração do Banco de Dados

Edite o arquivo `.env` e configure o PostgreSQL:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=banco_pratico
DB_USERNAME=postgres
DB_PASSWORD=postgres
```

Execute as migrações para criar as tabelas:

```bash
php artisan migrate
```

---

## 🔐 Configuração do MinIO

Edite o `.env` e configure o MinIO:

```env
FILESYSTEM_DISK=minio
MINIO_ACCESS_KEY=admin
MINIO_SECRET_KEY=admin123
MINIO_BUCKET=projeto
```

---

## 🏗️ Inicializar Servidor

Inicie a API com:

```bash
php artisan serve
```

A API estará disponível em `http://127.0.0.1:8000`

---

## 🔑 Autenticação e Autorização

A API utiliza Laravel Sanctum para autenticação por token.

### Registrar um novo usuário:

```http
POST /api/register
Content-Type: application/json
{
  "name": "Usuário Teste",
  "email": "teste@email.com",
  "password": "123456"
}
```

### Login e obtenção do token:

```http
POST /api/login
Content-Type: application/json
{
  "email": "teste@email.com",
  "password": "123456"
}
```

### Logout:

```http
POST /api/logout
Authorization: Bearer {TOKEN}
```

---

## 📌 Endpoints

### **Cidades**

- `GET /api/cidades` (Listar cidades paginadas)
- `POST /api/cidades` (Criar cidade)
- `GET /api/cidades/{id}` (Detalhes da cidade)
- `PUT /api/cidades/{id}` (Atualizar cidade)
- `DELETE /api/cidades/{id}` (Excluir cidade)

### **Servidores Efetivos**

- `GET /api/servidores-efetivos` (Listar servidores)
- `POST /api/servidores-efetivos` (Criar servidor)
- `GET /api/servidores-efetivos/{id}` (Detalhes do servidor)
- `PUT /api/servidores-efetivos/{id}` (Atualizar servidor)
- `DELETE /api/servidores-efetivos/{id}` (Excluir servidor)

### **Consulta Personalizada**

- `GET /api/servidores-efetivos/unidade/{id}` - Lista servidores de uma unidade
- `GET /api/servidores/enderecos?nome=xxxx` - Consulta endereço funcional pelo nome

---


