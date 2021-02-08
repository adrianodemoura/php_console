<?php
declare(strict_types=1);

/**
 * Exibe na tela o backTrace
 *
 * @param   string  $d Mensagem
 * @return  void
 */
function debug($d='', $trace=true) 
{
    $t = array_reverse(debug_backtrace());
    $m = array();
    foreach($t as $_l => $_arrProp)
    {
        if (isset($_arrProp['line']))
        {
            $m[$_arrProp['line']] = $_arrProp['file'];
        }
    }

    $c = 0;
    foreach($m as $_l => $_file)
    {
        $c++;
        if ( !$trace ) { if ( $c < count($m) ) { continue; } }

        echo $_file.' (linha: '.$_l.')';
        if ( PHP_SAPI === 'cli' ) echo "\n";
    }
    echo print_r($d,true);
    if ( PHP_SAPI === 'cli' ) echo "\n";
}

/**
 * Exibe na tela o backGrace e saí.
 *
 * @param   string  $d Mensagem
 * @return  void
 */
/*function dd($d='') 
{
    debug( $d );
    die("==\n");
}*/

/**
 * Escreve um Log no diretório temporário
 *
 * @param   string  $log        Nome do arquivo log.
 * @param   mixed   $conteudo   Conteúdo do logo.
 * @param   string  $tipo       Tipo da escrita, utiliza a+ para continuar a escrita, o padrão é re-escrever o arquivo.
 * @return  void
 */
function gravaLog($conteudo='', $nomeLog='log', $tipo='w')
{
    $fp = fopen( TMP . DS . $nomeLog.'.log', $tipo);

    ob_start();

    echo print_r($conteudo, true);

    $saida = ob_get_clean();
    fwrite($fp, $saida.PHP_EOL);
    fclose($fp);
}

function success( string $texto='' )
{
    echo print_r( $texto, true);
    if ( PHP_SAPI === 'cli' ) echo "\n";
}

function error( string $texto='' )
{
    echo print_r( $texto, true);
    if ( PHP_SAPI === 'cli' ) echo "\n";
}

function camelize( string $str='' )
{
    $i = array("-","_");
    $str = preg_replace('/([a-z])([A-Z])/', "\\1 \\2", $str);
    $str = preg_replace('@[^a-zA-Z0-9\-_ ]+@', '', $str);
    $str = str_replace($i, ' ', $str);
    $str = str_replace(' ', '', ucwords(strtolower($str)));
    $str = strtoUpper(substr($str,0,1)).substr($str,1);

    return $str;
}

function uncamelCase( string $str='' )
{
    $str = preg_replace('/([a-z])([A-Z])/', "\\1_\\2", $str);
    $str = strtolower($str);

    return $str;
}