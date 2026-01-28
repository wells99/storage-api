🚀 Storage API - Estrutura de Storage & Deploy
Bem-vindo!! Este projeto foi estruturado para ser leve, independente e, acima de tudo, autossuficiente.

Diferente de muitos projetos que dependem de serviços de terceiros (como AWS S3 ou Cloudinary) e acabam gerando custos e complexidade extra, aqui nós decidimos manter a soberania dos dados. As imagens são suas, estão no seu servidor e sob o seu controle total! 🛠️

🌟 A Vantagem do Self-Hosted Storage
Ter as imagens no próprio servidor, acessíveis via link simbólico, traz uma praticidade absurda:

Custo Zero: Sem taxas extras por armazenamento externo.

Privacidade: Seus dados não saem da sua hospedagem.

Velocidade: Menos requisições externas para o navegador processar.

🛠️ Passo a Passo para o Deploy (Ambiente Hostinger)
Se você está configurando este ambiente do zero ou passando para outro desenvolvedor, siga este guia:

1. Estrutura de Pastas
O projeto Laravel reside dentro de uma pasta chamada /api na raiz do seu site (public_html).

Código do Laravel: public_html/api/storage-api/

Acesso público: https://seudominio.com/api/

2. Configuração do Banco de Dados
Crie um Banco de Dados MySQL no painel da Hostinger.

No arquivo .env (em storage-api), atualize: DB_DATABASE, DB_USERNAME e DB_PASSWORD.

Garanta que APP_URL=https://seudominio.com/api.

3. Liberando o Poder do PHP
No painel da Hostinger (PHP Configuration > PHP Options), habilite temporariamente:

symlink, exec e shell_exec.

4. Permissões de Escrita (Vital! 🔑)
Para que o Laravel consiga salvar imagens e gerenciar o sistema, o servidor precisa de permissão de escrita. No Gerenciador de Arquivos ou via FTP, aplique o Chmod 775 (ou 777, dependendo da configuração do servidor) nas seguintes pastas dentro de storage-api:

storage/ (e todas as suas subpastas).

bootstrap/cache/.

Dica: Na Hostinger, você pode clicar com o botão direito na pasta e selecionar "Permissions" para aplicar recursivamente.

5. Rodando os Scripts Utilitários (A "Mágica")
Mova os arquivos da pasta /util para a pasta /api e execute-os via navegador:

migrate.php: Cria as tabelas do banco de dados automaticamente.

link.php: Cria o Link Simbólico (o túnel que faz as imagens aparecerem na web).

🔒 Segurança em Primeiro Lugar
Após confirmar que o login e o upload estão funcionando:

Desative as funções symlink, exec e shell_exec no painel PHP.

Delete os arquivos migrate.php e link.php da pasta /api.

Mantenha as cópias de segurança sempre protegidas na pasta /util.

Agora é só voar! Com as permissões ajustadas e os scripts rodados, você tem um backend robusto e imagens rápidas sob seu total comando. 🚀