<?php

/*

            echo 'Current card: '.$hand->cards[$i].'<br>';
            echo 'Last card: '.$hand->cards[$i-1].'<br>';
            echo 'Operation result: '.$cardsDifference.'<br>';
            echo '======================================================= <br>';
*/

function isStraight($hand) {
    
    if ( in_array(14, $hand) ) { 
        array_push($hand, 1);
        return true; 
    }else {
       return false; 
    }

    $hand = (object)array(
        'maxCardsPerHand' => 7,
        'straight' => 5,
        'cards' => $hand,
        'length' => count($hand)
    );
    var_dump($hand->existAS);

    if($hand->length >= $hand->straight  && $hand->length <= $hand->maxCardsPerHand) {
        sort($hand->cards);

        $consecutiveCounter = 1;

        // For loop starts
        for($i = 1; $i < $hand->length; $i++ ) {

            $cardsDifference = ($hand->cards[$i] - $hand->cards[$i-1]);

            if($cardsDifference === 1) {

                $consecutiveCounter++;

               if ($consecutiveCounter >= $hand->straight) {
                    return true;
                }

            } else {
                $consecutiveCounter = 1;
            }

        }
        // For loop ends

        return false;

    } else {
        return false;
    }
}


$hand = array(2,6,10,11,12,13,14);

var_dump(isStraight($hand));

?>