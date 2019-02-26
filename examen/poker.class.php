<?php
class Poker {
    public $hand = array();

    function __construct($hand) {
        $this->hand = $hand;
    }

    public function isStraight() {

        $indexAS = array_search(14, $this->hand);
        $this->hand[$indexAS] = 1;

        sort($this->hand);

        $handLength = count($this->hand);

        if ($handLength < 5) {
            return false;
        }
        
        $lastValue = $this->hand[0];
        $consecutiveCounter = 0;

        for($i = 0; $i < $handLength; $i++ ) {

            if(($this->hand[$i] - $lastValue) <= 1) {
                $consecutiveCounter++;

                echo 'Current card: '.$this->hand[$i].'<br>';
                echo 'Last card: '.$lastValue.'<br>';
                echo 'Operation result: '.($this->hand[$i] - $lastValue).'<br>';
                echo 'Consecutive Counter: '.$consecutiveCounter.'<br>';
                echo '======================================================= <br>';

                $lastValue = $this->hand[$i];
                if($consecutiveCounter === 5) {
                    return true;
                }
            } else {
                $consecutiveCounter = 0;
            }
        }
        echo 'Consecutive Counter: '.$consecutiveCounter.'<br>';
        return false;
    }

    /*public function isStraight2() {
        $this->hand = array_map(function ($n) {
            if ($n === 14) {
                return ($n = 1);
            } else {
                return $n;
            }
        }, $this->hand);

        sort($this->hand);

        $lastValue = $this->hand[0];
        $consecutiveCounter = 0;
        
        $this->hand = array_map(function ($currentValue){
            if(($this->hand[$i] - $lastValue) <= 1) {
                $consecutiveCounter++;
            }
        }, $this->hand);
    }*/
}


$hand = array(14,2,3,4,5);

//echo 'array_keys:' . var_dump(array_replace($hand, 14));

$poker = new Poker($hand);
var_dump($poker->isStraight());

?>