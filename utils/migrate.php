<?php
// migrate.php
exec("cd storage-api && php artisan migrate --force", $output, $return_var);
echo "Retorno: $return_var <br>";
print_r($output);

// APOS CONECTAR O BANCO VOCÊ DEVE RODAR ESTE SCRIPT PARA CRIAR AS TABELAS