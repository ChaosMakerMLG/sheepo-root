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

include 'php/charset.php';

$input = str_replace(' ', '', $input_raw);
$input_array = str_split($input);

#Bit shift all the characters based on input lenght

foreach($input_array as $char) {
    $index = array_search($char, $ascii_charset);
    if($index !== false) {
        $shifted_index = ($index + count($input_array));
        $shifted_input_array[] = $ascii_charset[$shifted_index];
    }
}

#Calculate key sum
$key_length = strlen($cipher_key);
$key_array = str_split($cipher_key);
$key_weight = 0;
$key_sum = 0;

foreach($key_array as $char) {
    $index = array_search($char, $ascii_charset);
    if($index !== false) {
        if (ctype_upper($char)) {
            $key_sum += pow($index, 2);
        } elseif (ctype_digit($char)) {
            $key_sum += $index + (int)$char;
        } elseif (ctype_punct($char)) {
            $key_sum += $index * 10;
        } else {
            $key_sum += $index;
        }
    }
}
#Calculate key weight

$key_weight = ($key_sum / ($key_length + count($input_array)) * M_PI);
$key_weight = (string)$key_weight; 
$i = 0;

while (strpos($key_weight, ".") !== 2) {
    if (strpos($key_weight, ".") < 2) {
        // If there are fewer than 2 digits before the decimal, multiply by 10
        $key_weight *= 10;
    } elseif (strpos($key_weight, ".") > 2) {
        // If there are more than 2 digits before the decimal, divide by 10
        $key_weight /= 10;
    }
    
    $key_weight = (string)$key_weight;  // Update as string for next iteration
    $i++;

    // Safety check to prevent infinite loop
    if ($i >= 10) {
        break;
    }
}

list($key_shift, $key_sequence) = explode('.', (string)$key_weight);
$key_sequence = str_replace('0', '', $key_sequence);
$key_sequence_array = str_split($key_sequence);

    foreach($shifted_input_array as $i => $char) {
        $index = array_search($char, $ascii_charset);
        if($index !== false) {
            $init_shifted_index = ($index + $key_shift);
            $sequence_digit = $key_sequence_array[$i];

            if($init_shifted_index >= count($ascii_charset)) {
                if ($i % 2 == 0) {
                    $final_index = (($init_shifted_index - $sequence_digit) - count($ascii_charset));
                }
                else {
                    $final_index = (($init_shifted_index + $sequence_digit) - count($ascii_charset));
                }
                
            }
            else {
                if ($i % 2 == 0) {
                    $final_index = ($init_shifted_index - $sequence_digit);
                }
                else {
                    $final_index = ($init_shifted_index + $sequence_digit);
                }
                
            }
            $encoded_array[] = $ascii_charset[$final_index];
            
        }

    }

    return implode('', $encoded_array);
}

echo shuffleEncode('NiggerLandiaEra', 'Ngjk&49njk231Dw2!');


function shuffleDecode($encoded_input, $cipher_key) {
    include 'php/charset.php';  // Include the character set, just as in the encoder.

    // Step 1: Set up basic parameters similar to the encoder.
    $encoded_array = str_split($encoded_input);
    $decoded_array = [];

    // Calculate the initial input length by reversing the shift done during encoding.
    $input_length = count($encoded_array);

    // Reverse key sum and weight calculation.
    $key_length = strlen($cipher_key);
    $key_array = str_split($cipher_key);
    $key_sum = 0;

    foreach ($key_array as $char) {
        $index = array_search($char, $ascii_charset);
        if ($index !== false) {
            if (ctype_upper($char)) {
                $key_sum += pow($index, 2);
            } elseif (ctype_digit($char)) {
                $key_sum += $index + (int)$char;
            } elseif (ctype_punct($char)) {
                $key_sum += $index * 10;
            } else {
                $key_sum += $index;
            }
        }
    }

    $key_weight = ($key_sum / ($key_length + $input_length) * M_PI);
    $key_weight = (string)$key_weight;

    // Adjust key weight string as in encoding.
    $i = 0;
    while (strpos($key_weight, ".") !== 2) {
        if (strpos($key_weight, ".") < 2) {
            $key_weight *= 10;
        } elseif (strpos($key_weight, ".") > 2) {
            $key_weight /= 10;
        }
        $key_weight = (string)$key_weight;
        $i++;
        if ($i >= 10) break;
    }

    list($key_shift, $key_sequence) = explode('.', (string)$key_weight);
    $key_sequence = str_replace('0', '', $key_sequence);
    $key_sequence_array = str_split($key_sequence);

    // Step 2: Reverse the key sequence-based shifting for each character.
    foreach ($encoded_array as $i => $char) {
        $index = array_search($char, $ascii_charset);
        if ($index !== false) {
            $sequence_digit = $key_sequence_array[$i % count($key_sequence_array)];
            if ($i % 2 == 0) {
                $init_shifted_index = $index + $sequence_digit;
            } else {
                $init_shifted_index = $index - $sequence_digit;
            }

            if ($init_shifted_index < 0) {
                $init_shifted_index += count($ascii_charset);
            }

            $final_index = ($init_shifted_index - $key_shift) % count($ascii_charset);
            if ($final_index < 0) {
                $final_index += count($ascii_charset);
            }

            $shifted_input_array[] = $ascii_charset[$final_index];
        }
    }

    // Step 3: Reverse the bit shift by input length.
    foreach ($shifted_input_array as $char) {
        $index = array_search($char, $ascii_charset);
        if ($index !== false) {
            $original_index = ($index - $input_length + count($ascii_charset)) % count($ascii_charset);
            $decoded_array[] = $ascii_charset[$original_index];
        }
    }

    return implode('', $decoded_array);
}

shuffleDecode('', '')

    ?>
</body>
</html>
