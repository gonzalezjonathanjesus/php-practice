<?php

/*
echo 'Current card: '.$hand[$i].'<br>';
echo 'Last card: '.$lastValue.'<br>';
echo 'Operation result: '.($hand[$i] - $lastValue).'<br>';
echo 'Consecutive Counter: '.$consecutiveCounter.'<br>';
echo '======================================================= <br>';
*/

function isStraight($hand) {
    $hand = (object)array(
        "maxCardsPerHand" => 7,
        "cards" => $hand,
        "length" => count($hand),
        "existAS" => in_array(14, $hand)
    );

    if($hand->length > $hand->maxCardsPerHand || $hand->length < 5) {
        return false;
    } else {
        sort($hand->cards);
        
        $consecutiveCounter = 0;

        array_filter($hand->cards, function ($key) use ($value){
            
        });

        for($i = 0; $i < $hand->length; $i++ ) {

            if($i === 0 || ($hand->cards[$i] - $hand->cards[$i-1]) <= 1) {

                $consecutiveCounter++;

                if ($hand->existAS) {
                    if($consecutiveCounter >= 4) {
                        return true;
                    }
                } else {
                    if($consecutiveCounter >= 5) {
                        return true;
                    }
                }

            } else {
                $consecutiveCounter = 0;
            }
        }
        return false;
    }
}


$hand = array(10,11,12,13,14);
var_dump(isStraight($hand));

?>