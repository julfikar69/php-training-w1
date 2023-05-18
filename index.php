<?php

$data = <<<'EOD'
X, -9\\\10\100\-5\\\0\\\\, A
Y, \\13\\1\, B
Z, \\\5\\\-3\\2\\\800, C
EOD;

$lines = explode("\n", $data); 

$output = array();

foreach ($lines as $line) {
    $parts = array_map('trim', explode(',', $line)); 

    $firstPart = $parts[0];
    $secondPart = preg_replace('/\\\\+/', ',', $parts[1]);
    $thirdPart = $parts[2];

    $values = explode(',', $secondPart); 
    sort($values, 1); 

    $counter = 1;
    foreach ($values as $value) {
        if(is_numeric($value)){
        	$output[] = $firstPart . ', ' . $value . ', ' . $thirdPart . ', ' . $counter;
        	$counter++;
        }
    }
}

usort($output, function ($a, $b) {
    $aValue = intval(explode(',', $a)[1]);
    $bValue = intval(explode(',', $b)[1]);

    if ($aValue == $bValue) {
        return 0;
    }

    return ($aValue < $bValue) ? -1 : 1;
});

foreach ($output as $line) {
    echo $line . "\n";
}
?>