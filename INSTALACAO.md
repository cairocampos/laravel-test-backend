<h1 align="center">Accordous</h1>

> Em desenvolvimento

## Instalação
### Configuração - Backend (Ambiente Docker)

``` bash
# Navegar até a pasta do backend
cd backend

# Rode o Docker compose
docker-compose up -d

# Instalar dependências do projeto
docker-compose exec app composer install

# Configurar variáveis de ambiente
cp .env.example .env
docker-compose exec app php artisan key:generate
```


### Configuração Frontend

``` bash
# Navegar até a pasta do frontend
cd frontend

# Rodo o docker compose
docker-compose up -d

# Abra o navegador e acesse o endereco http://localhost:8080
```

### Tela inicial do projeto
![Alt text](/images/tela01.jpeg)

Cairo Campos
