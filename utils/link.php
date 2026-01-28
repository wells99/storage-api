<!-- É NECESSÁRIO ATIVAR AS FUNÇÕES DO PHP NA HOSPEDAGEM -> ESSAS FORAM AS QUE ATIVEI TEMPORARIAMENTE symlink, exec, shell_exec -->

<?php
// Caminhos absolutos baseados nos prints
$target = '/home/u418451658/domains/wellservices.online/public_html/api/storage-api/storage/app/public';
$link = '/home/u418451658/domains/wellservices.online/public_html/api/storage-api/public/storage';

echo "Executando comando via shell...<br>";

// Tenta via comando de sistema (mais potente que a função do PHP)
exec("ln -s $target $link", $output, $return_var);

if ($return_var === 0) {
    echo "<strong>Sucesso!</strong> Link criado via shell.";
} else {
    echo "<strong>Falha.</strong> Código de erro: $return_var. Tentando via PHP nativo...<br>";
    
    if (symlink($target, $link)) {
        echo "<strong>Sucesso!</strong> Link criado via PHP.";
    } else {
        echo "<strong>Erro total.</strong> Verifique se a função symlink está ativa no Painel Hostinger > PHP Config.";
    }
}

