<?php
function isStraight($hand) {
    $hand = (object)array('maxCardsPerHand' => 8, 'straight' => 5, 'cards' => $hand, 'length' => count($hand) );
    if($hand->length >= $hand->straight  && $hand->length <= $hand->maxCardsPerHand) {
        if ( in_array(14, $hand->cards) ) { 
            array_push($hand->cards, 1);
            $hand->length = count($hand->cards);
        }
        sort($hand->cards);
        $consecutiveCounter = 1;
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
        return false;
    } else {
        return false;
    }
}


$hand = array(7, 8, 12, 13, 14);

var_dump(isStraight($hand));

?>