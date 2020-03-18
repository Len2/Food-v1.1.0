<?php

namespace App\Http\Controllers;

use App\Http\Requests\Invoice\CreateInvoiceRequest;
use App\Http\Requests\Invoice\UpdateInvoiceRequest;
use App\Http\Resources\InvoiceResource;
use Illuminate\Http\Request;
use App\Invoice;


class InvoiceController extends Controller
{

    public function index()
    {
        return InvoiceResource::collection(Invoice::paginate());
    }


    public function store(CreateInvoiceRequest $request)
    {
        $invoice = Invoice::create($request->all());
        return new InvoiceResource($invoice);
    }


    public function show(Invoice $invoice)
    {
        return new InvoiceResource($invoice);
    }


    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        $data = $request->only([
            'user_id', 'order_product_id', 'page_id', 'total', 'description', 'date', 'status', 'payment_method',
        ]);

        $invoice->update($data);
        return new InvoiceResource($invoice);
    }


    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return new InvoiceResource($invoice);
    }
}
