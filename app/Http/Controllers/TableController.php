<?php

namespace App\Http\Controllers;

use App\Http\Requests\Table\CreateTableRequest;
use App\Http\Requests\Table\UpdateTableRequest;
use App\Http\Resources\TableResource;
use Illuminate\Http\Request;
use App\Table;

class TableController extends Controller
{
    public function index()
    {
        return TableResource::collection(Table::paginate());
    }


    public function store(CreateTableRequest $request)
    {
        $table = Table::create($request->all());
        return new TableResource($table);
    }


    public function show(Table $table)
    {
        return new TableResource($table);
    }


    public function update(UpdateTableRequest $request, Table $table)
    {
        $data = $request->only([
            'table_number', 'nr_chairs', 'status', 'type_of_table', 'page_id'
        ]);

        $table->update($data);
        return new TableResource($data);
    }


    public function destroy(Table $table)
    {
        $table->delete();
        return new TableResource($table);
    }
}
