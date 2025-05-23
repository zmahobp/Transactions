<?php

declare(strict_types = 1);

$files = glob(FILES_PATH . '*.csv');
#turns the data from all CSV files from views directory into wanted kind of an array
function csv_data_to_array(array $files) :array{
    $data = [];
    
    if($files === false){
        echo 'Error reading .csv files.';
        return [];
    }
    elseif(empty($files))
    {
        echo 'There is no .csv files in the directory.';
        return [];
    }
    else{

        foreach($files as $file)
        {
            $data[] = csv_to_array($file);
        }
        $data = array_merge(...$data);
        return $data;
    }
    return [];
}

#turns data from the CSV file into wanted kind of an array
function csv_to_array(string $filePath) : array{
    $data = [];

    if(($handle = fopen($filePath, 'r')) === false)
    {
        echo 'Error opening the file.';
        return [];
    }

    $headers = fgetcsv($handle);

    while(($row = fgetcsv($handle))!==false)
    {
        $data[] = array_combine($headers, $row);
    }

    fclose($handle);

    return $data;
}

#function that calculates total income, total expense and net total and returns an array with those values
function calculate_totals(array $data) : array{
    $totals = ['totalIncome'=> 0.0, 'totalExpense'=> 0.0,'netTotal'=> 0.0 ];

    foreach($data as $record)
    {
        $amount= (float)str_replace(['$',','], '', $record['Amount']);
        if($amount<0){
            $totals['totalExpense']+=$amount;
        }
        else{
            $totals['totalIncome']+=$amount;
        }
    }
    $totals['netTotal']=$totals['totalIncome']+$totals['totalExpense'];    
    return $totals;
} 

#function that converts date to wanted format
function format_date(string $date) : string {
    return date('M j Y', strtotime($date));
}
