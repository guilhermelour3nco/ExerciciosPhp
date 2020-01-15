<?php

namespace Galoa\ExerciciosPhp\TextWrap;

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
    $newString = array("");
    $lineCounter = 0;
    $wordCounter = 0;

    while($wordCounter < count($stringWords)){
        $lineLength = strlen($newString[$lineCounter]);
        $wordLength = strlen($stringWords[$wordCounter]);

        if (($lineLength == 0 && $wordLength <= $maxLength) || ($lineLength + $wordLength +1 <= $maxLength)){

            if ($lineLength == 0) $newString[$lineCounter] = $stringWords[$wordCounter++];
            else $newString[$lineCounter] .= " " . $stringWords[$wordCounter++];

        } else { // Não há espaço na linha

            if ($wordLength <= $maxLength) {
                $newString[++$lineCounter] = $stringWords[$wordCounter++];

            } else { // A palavra é maior que o tamanho máximo

                // Número de linhas que a palavra pode ser quebrada
                $aux = (int)($wordLength/$maxLength);

                for($i=0;$i<=$aux;$i++){
                    $newString[++$lineCounter] = substr($stringWords[$wordCounter], $i * $maxLength, $maxLength);
                }
                $wordCounter++;
            }
        }
    }
    return $newString;
}
}
