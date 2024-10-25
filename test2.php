<?php

$patterns = [
    '/uploads/*.pdf',   // PDF documents
    '/uploads/*.doc',   // Microsoft Word documents (older format)
    '/uploads/*.docx',  // Microsoft Word documents (newer format)
    '/uploads/*.xls',   // Microsoft Excel spreadsheets (older format)
    '/uploads/*.xlsx',  // Microsoft Excel spreadsheets (newer format)
    '/uploads/*.ppt',   // Microsoft PowerPoint presentations (older format)
    '/uploads/*.pptx',  // Microsoft PowerPoint presentations (newer format)
    '/uploads/*.txt',   // Text files
    '/uploads/*.rtf',   // Rich Text Format files
    '/uploads/*.odt',   // OpenDocument Text files
    '/uploads/*.ods',   // OpenDocument Spreadsheet files
    '/uploads/*.odp',   // OpenDocument Presentation files
    '/uploads/*.html',  // HTML files
    '/uploads/*.xml',   // XML files
    '/uploads/*.md',    // Markdown files
    '/uploads/*.csv'    // Comma-separated values files
];

$disk_filled_bytes = (getDirectorySize('/uploads') + getDirectorySize('/backups'));


function getSizeForPatterns(array $patterns) {
    $totalSize = 0;

    foreach ($patterns as $extension) {
        // Get the list of files matching the current pattern
        $files = glob($extension);
        
        // Loop through each file and accumulate its size
        foreach ($files as $file) {
            if (is_file($file)) {
                $totalSize += filesize($file);
            }
        }
    }
    
    return $totalSize;
}


function getTotalSizeForPatterns($patterns) {

    $totalSizeForPatterns = getSizeForPatterns($patterns);
    return $totalSizeForPatterns;

}

function getTotalPercentageForPatterns($patterns, $disk_filled_bytes) {

    $totalSizeForPatterns = getSizeForPatterns($patterns);

    $totalRawPercentageForPatterns = $totalSizeForPatterns / $disk_filled_bytes * 100;

    $totalPercentageForPatterns = number_format($totalRawPercentageForPatterns, 1, '.', "");

    return $totalPercentageForPatterns;
}

?>