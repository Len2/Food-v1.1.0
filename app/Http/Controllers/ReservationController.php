<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Reservation;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations= Reservation::get();
        if(is_null($reservations)){
            return response()->json("No Reservations",404);
        }
    
        return response()->json($reservations,200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $request->validate([
        'user_id' => 'required',
        'table_id' => 'required',
        'page_id' => 'required',
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
        'number_of_persons' => 'required',
        ]);

        $reservations=Reservation::create($request->all());
        return response()->json($reservations,201);   
    }
       
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservations=Reservations::find($id);
        if(is_null($reservations)){
            return response()->json("Not found",404);
        }
        return response()->json($reservations,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $reservations=Reservation::find($id);
        $validator = $request->validate([
            //'user_id' => ['exists:users,id|regex:/^[0-9]+$/'],
             //'table_id' => ['exists:table,id|regex:/^[0-9]+$/'],
             //'page_id' => ['exists:restaurants,id|regex:/^[0-9]+$/'],
            'user_id' => 'regex:/^[0-9]+$/',
            'table_id' => 'regex:/^[0-9]+$/',
            'page_id' => 'regex:/^[0-9]+$/',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
            'number_of_persons' => 'regex:/^[0-9]+$/',
        ]);

        if(is_null($reservations)){
            return response()->json("Not found",404);
        } else {
            $reservations->update($request->all());
            return response()->json($reservations,200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservations=Reservation::find($id);

        if(is_null($reservations)){
            return response()->json("Not found",404);
        }
        $reservations->delete();
        return response()->json(null,200);
            
    }

}