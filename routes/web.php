<?php

use Illuminate\Support\Facades\Route;
use Spatie\Browsershot\Browsershot;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/generate-report', function(){

$html = view('pdf.invoice')->render(); //browsershot html expects a string not a view object as received without the render() method

$pdf = Browsershot::html($html) -> format('A4') -> margins(10,10,10,10)->pdf();

// to rather save to the  project's public directory, this can help
// Browsershot::html($html) -> format('A4') -> margins(10,10,10,10)->savePdf('invoice.pdf');

// to rather enable an inline view of the pdf in a new tab, this can help
// return response($pdf)->header('Content-Type', 'application/pdf')
//     ->header('Content-Disposition', 'inline; filename="invoice.pdf"');

return response($pdf)->header('Content-Type', 'application/pdf') -> header('Content-Disposition', 'attachment; filename="invoice.pdf"'); //attachment disposition triggers a download into user's machine


});