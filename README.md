<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<h1 align="center">
Moustache Animes
</h1>

### Sobre o projeto

Durante a faculdade, <a href="https://github.com/GabrielReguera">meu amigo</a> e eu fizemos um projeto bem simples, uma lista para salvar animes... recentemente resolvi explorar mais o Laravel e dei continuidade neste projeto, essas foram as implementações:

- Durante a criaçãoda conta, o usuário pode escolher uma foto de perfil
- Cada usuário pode fazer sua própria lista do que já assistiu
- Ele pode escolher uma nota para o anime e marcar quantos episódios já assistiu
- Ele pode acessar a página de informações do anime, deixar um comentário e/ou visualizar comentários de outros usuários

<strong>Nota:</strong> Eu tentei realizar o deploy desta aplicação e infelizmente não consegui, mas em breve colocarei um vídeo demonstrando as funcionalidades!

### Sobre o Laravel

Foi uma experiência incrível e desafiadora, principalmente por minha zona de conforto ser o Java! 

### Tutorial

Caso queira baixar o projeto em sua máquina, siga o tutorial abaixo.

<span>Instalar o projeto</span>
- Baixe o projeto e coloque em um lugar de sua preferência
- Abra o terminal (cmd) na pasta do projeto e digite: ``composer install``
- Copie e cole o arquivo ``.env.example``, mude o nome da cópia para ``.env``
- No terminal (cmd) gere uma chave com: ``php artisan key:generate``
- Abra o PostgreSQL e crie um banco de dados com o mesmo nome que está na ``.env``
- No terminal (cmd) digite ``php artisan migrate`` para gerar as tabelas

<span>Rodar o projeto</span>
- Abra dois terminais (cmd):
    - No primeiro você deve digitar: ``npm run dev``
    - No segundo você deve digitar: ``php artisan serve``
- Agora abra o navegador no endereço: ``127.0.0.1:8000``, por padrão, a conta do admin já é criada junto com as tabelas...
- Use esse login para cadastrar animes, estúdios e status:
    - admin@mail.com
    - 12345678
