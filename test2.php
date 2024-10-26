<?php
function shuffleEncode($input_raw, $cipher_key) {
    $ascii_charset = [
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

    // Remove spaces
    $input_clean = str_replace(' ', '', $input_raw);
    $input_length = strlen($input_clean);
    $input_array = str_split($input_clean);

    // Step 1: Initial shift based on input length
    $shifted_input_array = [];
    foreach ($input_array as $char) {
        $index = array_search($char, $ascii_charset);
        if ($index !== false) {
            $shifted_index = ($index + $input_length) % count($ascii_charset);
            $shifted_input_array[] = $ascii_charset[$shifted_index];
        }
    }

    // Step 2: Calculate cipher key weight
    $cipher_key_length = strlen($cipher_key);
    $cipher_key_array = str_split($cipher_key);
    $cipher_key_weight = 0;
    foreach ($cipher_key_array as $char) {
        $index = array_search($char, $ascii_charset);
        if ($index !== false) {
            if (ctype_upper($char)) {
                $cipher_key_weight += pow($index, 2);
            } elseif (ctype_digit($char)) {
                $cipher_key_weight += $index + (int)$char;
            } elseif (ctype_punct($char)) {
                $cipher_key_weight += $index * 10;
            } else {
                $cipher_key_weight += $index;
            }
        }
    }

    // Step 3: Calculate cipher pattern and sequence
    $cipher_pattern = ($cipher_key_weight / $cipher_key_length + $input_length) / $cipher_key_length * 10;
    list($cipher_shift, $cipher_sequence) = explode('.', (string)$cipher_pattern);
    $cipher_shift = (int)$cipher_shift;
    $cipher_sequence_array = str_split($cipher_sequence);

    // Step 4: Final shifting based on cipher sequence
    $encoded_array = [];
    foreach ($shifted_input_array as $i => $char) {
        $index = array_search($char, $ascii_charset);
        if ($index !== false) {
            $cipher_shifted_index = ($index + $cipher_shift) % count($ascii_charset);
            $sequence_digit = isset($cipher_sequence_array[$i % count($cipher_sequence_array)]) ? (int)$cipher_sequence_array[$i % count($cipher_sequence_array)] : 0;

            if ($i % 2 == 0) {
                $final_index = ($cipher_shifted_index + $sequence_digit) % count($ascii_charset);
            } else {
                $final_index = ($cipher_shifted_index - $sequence_digit + count($ascii_charset)) % count($ascii_charset);
            }
            $encoded_array[] = $ascii_charset[$final_index];
        }
    }

    // Join and return the encoded string
    return implode('', $encoded_array);
}


function shuffleDecode($encoded_input, $cipher_key) {
    $ascii_charset = [
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

    // Calculate the length of the original input (without spaces)
    $input_length = strlen($encoded_input);

    // Step 1: Calculate cipher key weight (same as in encoding)
    $cipher_key_length = strlen($cipher_key);
    $cipher_key_array = str_split($cipher_key);
    $cipher_key_weight = 0;
    foreach ($cipher_key_array as $char) {
        $index = array_search($char, $ascii_charset);
        if ($index !== false) {
            if (ctype_upper($char)) {
                $cipher_key_weight += pow($index, 2);
            } elseif (ctype_digit($char)) {
                $cipher_key_weight += $index + (int)$char;
            } elseif (ctype_punct($char)) {
                $cipher_key_weight += $index * 10;
            } else {
                $cipher_key_weight += $index;
            }
        }
    }

    // Step 2: Calculate cipher pattern and sequence
    $cipher_pattern = ($cipher_key_weight / $cipher_key_length + $input_length) / $cipher_key_length * 10;
    list($cipher_shift, $cipher_sequence) = explode('.', (string)$cipher_pattern);
    $cipher_shift = (int)$cipher_shift;
    $cipher_sequence_array = str_split($cipher_sequence);

    // Step 3: Reverse the final cipher shift and sequence
    $shifted_input_array = [];
    foreach (str_split($encoded_input) as $i => $char) {
        $index = array_search($char, $ascii_charset);
        if ($index !== false) {
            $cipher_shifted_index = ($index - $cipher_shift + count($ascii_charset)) % count($ascii_charset);
            $sequence_digit = isset($cipher_sequence_array[$i % count($cipher_sequence_array)]) ? (int)$cipher_sequence_array[$i % count($cipher_sequence_array)] : 0;

            // Reverse the addition and subtraction applied in encoding
            if ($i % 2 == 0) {
                $final_index = ($cipher_shifted_index - $sequence_digit + count($ascii_charset)) % count($ascii_charset);
            } else {
                $final_index = ($cipher_shifted_index + $sequence_digit) % count($ascii_charset);
            }
            $shifted_input_array[] = $ascii_charset[$final_index];
        }
    }

    // Step 4: Reverse the initial shift based on input length
    $decoded_array = [];
    foreach ($shifted_input_array as $char) {
        $index = array_search($char, $ascii_charset);
        if ($index !== false) {
            $original_index = ($index - $input_length + count($ascii_charset)) % count($ascii_charset);
            $decoded_array[] = $ascii_charset[$original_index];
        }
    }

    // Join and return the decoded string
    return implode('', $decoded_array);
}

$encoded_message = shuffleEncode('Hello World', 'AbcGH#JHhdfjd&^@*$!@897%');
echo "Encoded Message: " . $encoded_message . "\n";
$decoded_message = shuffleDecode($encoded_message, 'AbcGH#JHhdfjd&^@*$!@897%');
echo "Decoded Message: " . $decoded_message . "\n";

?>

