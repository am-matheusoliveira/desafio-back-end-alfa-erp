<?php

// Verifica se o caminho dos arquivos foi fornecido
if ($argc < 3) {
    echo "Uso: php alterar_conteudo.php <arquivo_destino> <arquivo_origem>\n";
    exit(1);
}

$caminhoArquivoDestino = $argv[1];
$caminhoArquivoOrigem = $argv[2];

// Lê o conteúdo do arquivo de origem
$novoConteudo = file_get_contents($caminhoArquivoOrigem);

if ($novoConteudo === false) {
    echo "Erro ao tentar ler o arquivo de origem.\n";
    exit(1);
}

// Escreve o conteúdo no arquivo de destino
if (file_put_contents($caminhoArquivoDestino, $novoConteudo) !== false) {
    echo "Conteúdo do arquivo '{$caminhoArquivoDestino}' foi alterado com sucesso.\n";
} else {
    echo "Erro ao tentar alterar o conteúdo do arquivo.\n";
}