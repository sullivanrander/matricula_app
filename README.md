# Matrícula API

### Setup do pojeto
Para iniciar o projeto é necessário ter o Composer instalado
na maquina, após a instalação do composer é necessário entrar
na pasta raiz do projeto e instalar as dependências do projeto:
```
$ artisan install
```

### Instalando a base de dados
Para instalar a base de dados é preciso ter o MySQL instalado
na máquina, após a instalação abra o arquivo .env na raiz do
projeto e altere as configurações de banco de dados de acordo
com os da sua máquina:
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=matricula
DB_USERNAME=root
DB_PASSWORD=12345678
```

### Migrações
Instale as migrações junto com os dados de teste:
```
$ php artisan migrate:fresh --seed
```

### Servindo a aplicação
Inicie o servidor de teste e verifique o funcionamento em 
http://localhost:8000:
```
$ php artisan serve
```
