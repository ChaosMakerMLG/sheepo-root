<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <?php
    ini_Set("display_errors", "On");

function shuffleEncode($input_raw, $cipher_key) {
    $ascii_charset=[
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 
        'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 
        'u', 'v', 'w', 'x', 'y', 'z',
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 
        'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 
        'U', 'V', 'W', 'X', 'Y', 'Z',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
        '!', '@', '#', '$', '%', '^', '&', '*', '(', ')',
        '-', '_', '=', '+', '[', '{', ']', '}', ';', ':',
        "'", '"', '\\', '|', ',', '<', '.', '>', '/', '?',
        '~', '`'
    ];
    $input_clean=str_replace(' ', '' ,$input_raw);
    $input_length = strlen($input_clean);
    $input_array=str_split($input_clean);
    $x = 0;
    for($i = 0; $i < $input_length; $i++) {
        $foo=array_search($input_array[$x], $ascii_charset);
        $shifted_index=$foo + strlen($input_clean);
        $shifted_input_array[$x] = $ascii_charset[$shifted_index];
        $x++;
    }
    $cipher_key_length=strlen($cipher_key);
    $cipher_key_array=str_split($cipher_key);
    $y = 0;
    $cipher_key_weight = 0;
    for($i = 0; $i < $cipher_key_length; $i++) {
        $foo=array_search($cipher_key_array[$y], $ascii_charset);
        if(ctype_upper($cipher_key_array[$y])) { $fee=pow($foo, 2); }
        elseif(ctype_digit($cipher_key_array[$y])) { $fee=$foo + (int)$cipher_key_array[$y]; }
        elseif(ctype_punct($cipher_key_array[$y])) { $fee=$foo * 10; }
        else {
            $fee=$foo;
        }
        $y++;
        $cipher_key_weight += $fee;
    }
    $cipher_pattern = (($cipher_key_weight / $cipher_key_length += $input_length) / $cipher_key_length * 10);
    list($cipher_shift, $cipher_sequence) = explode('.', (string)$cipher_pattern);
    $cipher_sequence_array=str_split(str_replace('0', '' ,$cipher_sequence));
    $z = 0;
    $cipher_shifted_index = ((int)$shifted_index + (int)$cipher_shift);
    echo $cipher_shifted_index;
    /* while($cipher_shifted_index > count($ascii_charset)) {
        (int)$cipher_shifted_index - count($ascii_charset);
    } */
    echo $cipher_shifted_index;                                                                                                                                                                                                                                                                                                                                                     
    /* for($i = 0; $i < strlen($cipher_sequence); $i++) {
        $cipher_shifted_index = (int)$shifted_index + (int)$cipher_shift;
        while($cipher_shifted_index > count($ascii_charset)) {
            (int)$cipher_shifted_index - count($ascii_charset);
        }
        if($i % 2 == 0) {
            $shifted_input_array[$z] = (int)$ascii_charset[$cipher_shifted_index] + (int)$cipher_sequence_array[$z];
        }
        else {
            $shifted_input_array[$z] = (int)$ascii_charset[$cipher_shifted_index] - (int)$cipher_sequence_array[$z];
        }
        $z++;
        if ($z > $input_length) {
            $z = 0;
        }
        if($i > strlen($cipher_sequence)) {
            break;
        }   
} */



    return implode('', $shifted_input_array);
}

shuffleEncode('Hello World', 'AbcGH#JHhdfjd&^@*$!@897%');
    ?>
</body>
</html>
