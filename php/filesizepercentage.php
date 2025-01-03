<?php

$disk_filled_bytes = getDirectorySize('/uploads');


function getSizeForPatterns(array $patterns, $baseDir) {
    $totalSize = 0;

    // Create a RecursiveDirectoryIterator to traverse directories
    $directoryIterator = new RecursiveDirectoryIterator($baseDir, RecursiveDirectoryIterator::SKIP_DOTS);
    $iterator = new RecursiveIteratorIterator($directoryIterator, RecursiveIteratorIterator::LEAVES_ONLY);

    // Loop through each file in the directories
    foreach ($iterator as $file) {
        if ($file->isFile()) {
            // Check if the file matches any of the patterns
            foreach ($patterns as $pattern) {
                $patternRegex = str_replace(['*', '/'], ['.*', '\/'], $pattern);
                $patternRegex = '/^' . $patternRegex . '$/';
                $filePath = $file->getPathname();
                
                // If the file path matches the pattern, add its size
                if (preg_match($patternRegex, $filePath)) {
                    $totalSize += $file->getSize();
                    break; // Stop checking other patterns once a match is found
                }
            }
        }
    }

    return $totalSize;
}


function getTotalSizeForPatterns($patterns, $baseDir) {

    $totalSizeForPatterns = getSizeForPatterns($patterns, $baseDir);
    return $totalSizeForPatterns;

}

function getTotalPercentageForPatterns($patterns, $disk_filled_bytes, $baseDir) {

    $totalSizeForPatterns = getSizeForPatterns($patterns, $baseDir);

        if($disk_filled_bytes < 1 || $disk_filled_bytes === NULL) {

            $totalPercentageForPatterns = number_format(0, 1, '.', "w");
            return $totalPercentageForPatterns;
        }

    $totalRawPercentageForPatterns = $totalSizeForPatterns / $disk_filled_bytes * 100;

    $totalPercentageForPatterns = number_format($totalRawPercentageForPatterns, 1, '.', "w");

    return $totalPercentageForPatterns;
}

?>