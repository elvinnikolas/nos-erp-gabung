<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\invoicepiutang;
use App\lokasi;

class InvoiceController extends Controller
{
    public function piutang(){
        $invoice = DB::select('SELECT i.KodeInvoicePiutangShow, i.KodeInvoicePiutang, p.NamaPelanggan, i.Tanggal, d.Subtotal, COALESCE(sum(pp.Jumlah),0) as bayar FROM invoicepiutangs i inner join invoicepiutangdetails d on i.KodeInvoicePiutang = d.KodeInvoicePiutang inner join pelanggans p on p.KodePelanggan = i.KodePelanggan 
left join pelunasanpiutangs pp on pp.KodeInvoice = i.KodeInvoicePiutang
GROUP by i.KodeInvoicePiutangShow, i.KodeInvoicePiutang, p.NamaPelanggan, i.Tanggal, d.Subtotal');
        return view('invoice.piutang.index',compact('invoice'));
    }
}
