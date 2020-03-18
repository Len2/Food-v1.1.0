<?php
namespace App\Http\Controllers;

use App\Http\Requests\Reservation\CreateReservationRequest;
use App\Http\Requests\Reservation\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use Illuminate\Http\Request;
use App\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        return ReservationResource::collection(Reservation::paginate());
    }


    public function store(CreateReservationRequest $request)
    {
        $reservation = Reservation::create($request->all());
        return new ReservationResource($reservation);
    }


    public function show(Reservation $reservation)
    {
        return new ReservationResource($reservation);
    }


    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $data = $request->only([
            'user_id', 'table_id', 'page_id', 'date', 'time', 'number_of_persons',
        ]);

        $reservation->update($data);

        return new ReservationResource($reservation);
    }


    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return new ReservationResource($reservation);
    }
}
