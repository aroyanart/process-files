<?php
/**
 * Checks if a file is lexicographically sorted.
 */
function isSorted(string $filename): bool {
    $handle = fopen($filename, 'r');
    if (!$handle) return false;

    $prevLine = fgets($handle);
    while (($currentLine = fgets($handle)) !== false) {
        if (strcmp(trim($prevLine), trim($currentLine)) > 0) {
            fclose($handle);
            return false; // File is not sorted
        }
        $prevLine = $currentLine;
    }
    fclose($handle);
    return true;
}

/**
 * Processes two input files and generates output files containing unique words.
 */
function processFiles(string $file1, string $file2, string $output1, string $output2): void {
    if (!isSorted($file1) || !isSorted($file2)) {
        die("Error: Input files must be lexicographically sorted.\n");
    }

    $handle1 = fopen($file1, 'r');
    $handle2 = fopen($file2, 'r');
    $out1 = fopen($output1, 'w');
    $out2 = fopen($output2, 'w');

    if (!$handle1 || !$handle2 || !$out1 || !$out2) {
        die("Error opening files");
    }

    $line1 = fgets($handle1);
    $line2 = fgets($handle2);

    while ($line1 !== false || $line2 !== false) {
        $line1 = $line1 !== false ? trim($line1) : null;
        $line2 = $line2 !== false ? trim($line2) : null;

        if ($line1 === '') $line1 = null;
        if ($line2 === '') $line2 = null;

        // If line1 is unique, write to output1
        if ($line1 !== null && ($line2 === null || strcmp($line1, $line2) < 0)) {
            fwrite($out1, $line1 . "\n");
            $line1 = fgets($handle1);
        }
        // If line2 is unique, write to output2
        elseif ($line2 !== null && ($line1 === null || strcmp($line1, $line2) > 0)) {
            fwrite($out2, $line2 . "\n");
            $line2 = fgets($handle2);
        }
        // If both lines are equal, skip and move to the next lines
        else {
            $line1 = fgets($handle1);
            $line2 = fgets($handle2);
        }
    }

    fclose($handle1);
    fclose($handle2);
    fclose($out1);
    fclose($out2);

    echo "Processing completed!\n";
}

// Define input and output file names
$inputFile1 = 'input1.txt';
$inputFile2 = 'input2.txt';
$outputFile1 = 'output1.txt';
$outputFile2 = 'output2.txt';

// Execute the processing function
processFiles($inputFile1, $inputFile2, $outputFile1, $outputFile2);
