<?php

namespace App\Http\Controllers;

use App\Http\Resources\InvoiceResource;
use Illuminate\Http\Request;
use App\Invoice;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Http\Requests\Invoice\CreateInvoiceRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;


class InvoiceController extends Controller
{


    protected $path;
    function __construct()
    {
        $this->path = storage_path('app\public\invoice\\');
    }
    public function index()
    {
        if (!Gate::allows('invoice-list')) {
            throw new AuthorizationException('You have not permission');
        }
        return $contents = Storage::get('invoice/wjKrLmiQSXXDxP2prdZ6I7G0b51PHRfYSheKUbkQ.pdf');
        //InvoiceResource::collection(Invoice::all());
    }


    public function store(CreateInvoiceRequest $request)
    {

        $invoice= new Invoice;
        $invoice->order_id = $request->order_id;

        $invoice->order_id = $request->order_id;
        $invoice->status = $request->status;
        $invoice->description = $request->description;
        if ($request->hasFile('file')) {
            $request->file('file')->store('public\invoice');
            $fileHash = $request->file->hashName();
            $invoice->file = $fileHash;
        }

        $invoice->save();

        return new InvoiceResource($invoice);
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice){

        $invoice->status = $request->status;
        $invoice->description = $request->description;
        $invoice->save();
        return new InvoiceResource($invoice);
    }

    public function destroy(Invoice $invoice)
    {
        if (!Gate::allows('invoice-delete')) {
            throw new AuthorizationException('You have not permission');
        }

        $invoice->delete();
        $imagePath = $invoice->file;
        if (\File::exists($this->path.$imagePath)) {
            unlink($this->path.$imagePath);
        }
        return response()->json(null,200);
    }
}
