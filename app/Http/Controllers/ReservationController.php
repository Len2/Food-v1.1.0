<?php
namespace App\Http\Controllers;

use App\Http\Requests\Reservation\CreateReservationRequest;
use App\Http\Requests\Reservation\UpdateReservationRequest;
use App\Http\Resources\ReservationResource;
use Illuminate\Http\Request;
use App\Reservation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Access\AuthorizationException;

class ReservationController extends Controller
{

    function __construct()
    {
        if(Auth::guard("user_pages")->user()== ''){
            $this->user=Auth::guard("api")->user();
        }else{
            $this->user=Auth::guard("user_pages")->user();
        }
    }
    public function index()
    {

        if (!Gate::allows('reservation-list')) {
            throw new AuthorizationException('You have not permission');
        }

        if($this->user->hasRole('Admin')){
            return ReservationResource::collection(Reservation::all());
        }else{
            $page=$this->user->reservation;
            return ReservationResource::collection($page);
        }

    }


//    public function store(CreateReservationRequest $request)
//    {
//        $reservation = Reservation::create($request->all());
//        return new ReservationResource($reservation);
//    }


    public function show(Reservation $reservation)
    {
        if (!Gate::allows('reservation-single')) {
            throw new AuthorizationException('You have not permission');
        }
        $reservation->user;
        $reservation->page;
        return new ReservationResource($reservation);
    }


    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $data = $request->only([
            'status'
        ]);
        $reservation->update($data);
        return new ReservationResource($reservation);
    }


    public function destroy(Reservation $reservation)
    {
        if (!Gate::allows('reservation-delete')) {
            throw new AuthorizationException('You have not permission');
        }
        $reservation->delete();
        return new ReservationResource($reservation);
    }
}
