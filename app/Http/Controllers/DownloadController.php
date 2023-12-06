<?php

namespace App\Http\Controllers;

use App\Models\CreditBill;
use App\Models\ElectricBill;
use App\Models\InternetBill;
use Illuminate\Http\Request;
use PDF;

class DownloadController extends Controller
{
    public function pdfAllEB()
    {
        // Retrieve all internet bills
        $electricBill = ElectricBill::all();
    
        // Load the view with all internet bills
        $pdf = PDF::loadView('saldo.DownloadEB_pdf', compact('electricBill'));
    
        // Stream the PDF for download
        return $pdf->stream('all_electric_bill.pdf');
    }
    public function pdfAllIB()
    {
        // Retrieve all internet bills
        $internetBill = InternetBill::all();
    
        // Load the view with all internet bills
        $pdf = PDF::loadView('saldo.DownloadIB_pdf', compact('internetBill'));
    
        // Stream the PDF for download
        return $pdf->stream('all_internet_bill.pdf');
    }
    public function pdfAllCB()
    {
        // Retrieve all internet bills
        $creditBill = CreditBill::all();
    
        // Load the view with all internet bills
        $pdf = PDF::loadView('saldo.DownloadCB_pdf', compact('creditBill'));
    
        // Stream the PDF for download
        return $pdf->stream('all_credit_bill.pdf');
    }
}
