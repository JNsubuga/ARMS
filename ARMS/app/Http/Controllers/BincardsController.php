<?php

namespace App\Http\Controllers;

use App\Models\Bincard;
use PDF;
use Illuminate\Http\Request;

class BincardsController extends Controller
{
    public function index()
    {
        $bincards = Bincard::all();
        return view('bincards.index', ['bincards' => $bincards]);
    }

    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // // public function downloadPDF(array $array)
    public function downloadPDF()
    {
        // dd(request($sales));
        $bincardsData = Bincard::get();
        // dd($salesData);
        // $pdfOutput = [
        //     'Title' => 'Sales List',
        //     'Date' => date('d/m/Y'),
        //     'sales' => $salesData
        // ];
        // $pdf = PDF::loadView('sales.downloadSalesPdf', $pdfOutput);
        $pdf = PDF::loadView('bincards.PDF.downloadBincardsPdf', ['bincards' => $bincardsData]);
        return $pdf->download(date('Ymd', strtotime(now())) . 'BincardsList.pdf');
    }
}
