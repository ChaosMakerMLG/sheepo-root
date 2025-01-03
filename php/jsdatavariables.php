<?php 

include 'filesizepercentage.php';

function formatBytes($bytes, $precision = 1) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 
   
    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 
    $bytes /= pow(1024, $pow);
   
    return round($bytes, $precision) . $units[$pow]; 
}

$path1 = '/uploads';
$path2 = '/backups';

function removeTrailingZeros($number) {
    return rtrim(rtrim(sprintf('%.1f', $number), '0'), '.');
}


function getDirectorySize($path){
    $folderbytes = 0;
    $path = realpath($path);
    if($path!==false && $path!='' && file_exists($path)){
        foreach(new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $object){
            $folderbytes += $object->getSize();
        }
    }
    return $folderbytes;
    }

$disk_filled_space_gigabytes = formatBytes(getDirectorySize($path1) + getDirectorySize($path2));
$disk_max_space_gigabytes = formatBytes(disk_total_space("/"));
$disk_free_space_gigabytes = formatBytes(disk_total_space("/") - (getDirectorySize($path1) + getDirectorySize($path2)));

$disk_filled_space_bytes = (getDirectorySize($path1) + getDirectorySize($path2));
$disk_max_space_bytes = (disk_total_space("/"));
$disk_free_space_bytes = (disk_total_space("/") - (getDirectorySize($path1) + getDirectorySize($path2)));

$percentage_archives = removeTrailingZeros(getTotalPercentageForPatterns($pattern_archives, $disk_filled_space_bytes, $path1));
$percentage_images = removeTrailingZeros(getTotalPercentageForPatterns($pattern_images, $disk_filled_space_bytes, $path1));
$percentage_documents = removeTrailingZeros(getTotalPercentageForPatterns($pattern_documents, $disk_filled_space_bytes, $path1));
if (is_numeric($disk_filled_space_bytes) && $disk_filled_space_bytes > 0) {
    $percentage_backups = removeTrailingZeros(number_format(((getDirectorySize('/backups') / $disk_filled_space_bytes) * 100), 2, '.', ""));
} else {
    $percentage_backups = removeTrailingZeros(number_format(0, 2, '.', ""));
}
$percentage_text = removeTrailingZeros(getTotalPercentageForPatterns($pattern_text, $disk_filled_space_bytes, $path1));
$percentage_audio = removeTrailingZeros(getTotalPercentageForPatterns($pattern_audio, $disk_filled_space_bytes, $path1));
$percentage_video = removeTrailingZeros(getTotalPercentageForPatterns($pattern_video, $disk_filled_space_bytes, $path1));

$bytes_archives = getTotalSizeForPatterns($pattern_archives, $path1);
$bytes_images = getTotalSizeForPatterns($pattern_images, $path1);
$bytes_documents = getTotalSizeForPatterns($pattern_documents, $path1);
$bytes_backups = getDirectorySize('/backups');
$bytes_text = getTotalSizeForPatterns($pattern_text, $path1);
$bytes_audio = getTotalSizeForPatterns($pattern_audio, $path1);
$bytes_video = getTotalSizeForPatterns($pattern_video, $path1);



?>
