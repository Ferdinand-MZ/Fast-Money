<?php

namespace App\Http\Controllers;

use App\Models\InternetBill;
use App\Models\CreditBill;
use App\Models\ElectricBill;
use App\Models\User;
use Pdf;

class PDFController extends Controller
{
    public function pdfInternetBill($id)
    {

        $internetBill = InternetBill::select('internet_bills.*')->where('internet_bills.id', $id)->get();

        $pdf = PDF::loadView('saldo.InternetBill_pdf', compact('internetBill'));

        return $pdf->stream('internet_bill.pdf');
    }
    public function pdfAllInternetBill()
{
    // Retrieve all internet bills
    $internetBill = InternetBill::all();

    // Load the view with all internet bills
    $pdf = PDF::loadView('saldo.AllInternetBill_pdf', compact('internetBill'));

    // Stream the PDF for download
    return $pdf->stream('all_internet_bill.pdf');
}
    public function pdfElectricBill($id)
    {

        $electricBill = ElectricBill::select('electric_bills.*')->where('electric_bills.id', $id)->get();

        $pdf = PDF::loadView('saldo.ElectricBill_pdf', compact('electricBill'));

        return $pdf->stream('electric_bill.pdf');
    }

    public function pdfAllElectricBill()
    {
        // Retrieve all internet bills
        $electricBill = ElectricBill::all();
    
        // Load the view with all internet bills
        $pdf = PDF::loadView('saldo.AllElectricBill_pdf', compact('electricBill'));
    
        // Stream the PDF for download
        return $pdf->stream('all_electric_bill.pdf');
    }
   
    public function pdfCreditBill($id)
    {

        $creditBill = CreditBill::select('credit_bills.*')->where('credit_bills.id', $id)->get();

        $pdf = PDF::loadView('saldo.CreditBill_pdf', compact('creditBill'));

        return $pdf->stream('credit_bill.pdf');
    }
    public function pdfAllCreditBill()
    {
        // Retrieve all internet bills
        $creditBill = CreditBill::all();
    
        // Load the view with all internet bills
        $pdf = PDF::loadView('saldo.AllCreditBill_pdf', compact('creditBill'));
    
        // Stream the PDF for download
        return $pdf->stream('all_credit_bill.pdf');
    }
    public function pdfAllUsers()
    {
        // Retrieve all internet bills
        $users = User::all();
    
        // Load the view with all internet bills
        $pdf = PDF::loadView('saldo.AllUsers_pdf', compact('users'));
    
        // Stream the PDF for download
        return $pdf->stream('all_users.pdf');
    }
}
