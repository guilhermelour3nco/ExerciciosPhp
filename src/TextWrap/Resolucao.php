<?php

namespace Galoa\ExerciciosPhp\TextWrap;
include('TextWrapInterface.php');

/**
 * Implemente sua resolução aqui.
 */
class Resolucao implements TextWrapInterface {

  /**
   * {@inheritdoc}
   */
  public function textWrap(string $originalString, int $maxLength): array {
    //TESTE 1 => retorna um array vazio se a string também for vazia
    if ($originalString == "") return array("");

    //obtém as palavras da string
    $stringWords = preg_split("/ /", $originalString);
    $newString = array();
    $currentLine = "";

    foreach ($stringWords as $currentWord) {
        //verifica se (a linha esta vazia && a palavra cabe nela) || (se ainda tem espaço na linha) 
        if ((strlen($currentLine) == 0 && strlen($currentWord) <= $maxLength) || (strlen($currentLine) + strlen($currentWord) + 1 <= $maxLength)) {

            if (strlen($currentLine) == 0) $currentLine = $currentWord;
            else $currentLine = $currentLine . " " . $currentWord;

        } else { // Neste caso nao ha espaco na linha

            if (strlen($currentWord) <= $maxLength) {
                // Encerra a linha atual e adiciona a palavra na proxima linha 
                $newString[] = $currentLine;
                $currentLine = $currentWord;

            } else { // A palavra é maior que o tamanho maximo

                /*

                AVISO: IMPLEMENTACAO INACABADA
                este é um arquivo php separado para testes

                OUTPUT: array $words
                Array
                (
                [0] => This is
                [1] => an test
                [2] => forword
                [3] => sthatar
                [4] => ebigger
                [5] => thanlin
                [6] => es
                )

                <?php

                //testScript
                
                $words = ["This is", "an"];
                $currentWord = "testforwordsthatarebiggerthanlines";
                $maxLength = 7;
                
                $aux = count($words)-1;
                $cutLength = $maxLength - strlen($words[$aux]) - 1; 
                
                if (strlen($words[$aux]) == 0){ //insere a palavra em linhas vazias
                    $cutWord = str_split($currentWord, $maxLength);
                
                    foreach ($cutWord as $part){
                        $words[$aux++] = $part;
                    }
                
                }else{
                
                    $cutWord = str_split($currentWord);
                    $words[$aux] .= " ";
                
                    for ($i = 0; $i < $cutLength; $i++){
                        // adiciona no restante da linha
                        $words[$aux] .= $cutWord[$i];
                    }
                    $words[] = "";
                    $auxString = array();
                
                    for($i = $cutLength; $i < strlen($currentWord); $i++){
                        $auxString[] = $cutWord[$i];
                    }
                
                    $auxString = implode($auxString);
                    $cutWord = str_split($auxString, $maxLength);
                
                    foreach ($cutWord as $part){
                        $words[++$aux] = $part;
                    }
                }
                
                print_r($words); 
                ?> 
                */
            }
        }
    }
    // Adiciona ultima linha
    if (strlen($currentLine) != 0) {
        $newString[] = $currentLine;
    }
    return $newString;
}

}
