<?php
//s
function swap(Array &$array)
{
    $tmp = $array[0];
    $array[0] = $array[1];
    $array[1] = $tmp;
}
//p
function pick(Array &$from, Array &$to)
{
    if (isset($from[0]))
    {
        $new_first = array_shift($from);
        array_unshift($to, $new_first);         
    }
}

//r 
function rotate_left(Array &$array)
{
    $first_to_last = array_shift($array);
    array_push($array, $first_to_last);
}
//rr 
function rotate_right(Array &$array)
{
    $last_to_first = array_pop($array);
    array_unshift($array, $last_to_first);
}

function is_sorted(Array $array)
{
    $sorted = $array;
    sort($sorted);
    if ($array == $sorted)
        return true;
}

function get_median($length)
{
    if ($length % 2 != 0)
    {
        return ceil($length / 2);
    }
    else
    {
        return $length / 2 - 1;
    }
}
$start_time = microtime(true);


array_shift($argv);
//variables tableaux la et lb
$la = $argv;
$lb = [];
$result = [];
$length = count($la);


if (count($la) > 0 && is_sorted($la) == false)
{
    while (!is_sorted($la) || count($lb) > 0) {
      
        if (count($la) > 0 && !is_sorted($la))
        {
            $min = min($la);
            $max = max($la);
            $count = count($la);
        }
        else if (count($la) > 0 && is_sorted($la) || count($la) == 0)
        {
            do {
                pick($lb, $la);
                $result[] = "pa";
                var_dump("la", $la);
                var_dump("lb", $lb);
                sleep(1);	
            }
            while (count($lb) > 0);
            break;
        }

        //
        if ($min == $la[0])
        {
            pick($la, $lb);
            $result[] = "pb";
        }
        else if ($min == $la[$count - 1])
        {
            rotate_right($la);
            $result[] = "rra";
        }
        else if ($max == $la[0])
        {
            rotate_left($la);
            $result[] = "ra";
        }
        else
        {
            //array_search == index de l'element minimum de $la
            if ($min == $la[1])
            {
                swap($la);
                $result[] = "sa";
            }
            else if (array_search($min, $la) > get_median($count))
            {
                do{
                    $key_min = array_search($min, $la);
                    rotate_right($la);
                    $result[] = "rra";
                    var_dump("la", $la);
                    var_dump("lb", $lb);
                    sleep(1);
                }
                while($key_min != count($la) - 1);
            }
            else if (array_search($min, $la) <= get_median($count))
            {
                do{
                    $key_min = array_search($min, $la);
                    rotate_left($la);
                    $result[] = "ra";
                    var_dump("la", $la);
                    var_dump("lb", $lb);
                    sleep(1);
                }
                while($key_min < 2);
            }

        }
        sleep(1);
        var_dump("la", $la);
        var_dump("lb", $lb);
    }
    echo implode(" ", $result) . PHP_EOL;
}

$end_time = microtime(true);
// Calculate script execution time
$execution_time = ($end_time - $start_time);
  
echo " Execution time of script = ".$execution_time." sec" . PHP_EOL;
