<?php
function isStraight($hand) {
    $hand = (object)array(
        'maxCardsPerHand' => 7, 
        'straight' => 5, 
        'cards' => $hand,
        'length' => count($hand)
    );
    if($hand->length >= $hand->straight  && $hand->length <= $hand->maxCardsPerHand) {
        sort($hand->cards);
        if ($hand->cards[$hand->length - 1] == 14 ) { 
            array_unshift($hand->cards, 1);
            $hand->length++;
        }
        $iterations = $hand->length - $hand->straight;
        for($i = 0; $i <= $iterations; $i++ ) {
            if($hand->cards[$i + 4] == ($hand->cards[$i] + 4)) {
                return true;
            }
        }
        return false;
    } else {
        return false;
    }
}

$hand = array(7, 3, 2);

var_dump(isStraight($hand));

?>