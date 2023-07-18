<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Http\Response;
use App\Http\Requests\CreateTicketRequest;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'error' => false,
            'users' => Ticket::all(),
            'texto' => 'Tickets',
            ], Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateTicketRequest $request)
    {
        try{
            $newTicket = Ticket::create($request->safe()->only([
                'subject',
                'details',
                'assigned_to',
                'priority',
            ]));

            return response()->json([
                'error' => false,
                'user'  => $newTicket,
            ], Response::HTTP_OK);

        }
        catch(\Exception $error){

            return response()->json([
                'error'     => true,
                'message'   => 'Hubo un error al crear el ticket. Mensaje : '.$error->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

    }
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{

            $validateData = validator([
                'subject'               => 'required|max:40|alpha',
                'assigned_to'           => 'required|integer' #Dudas aqui!
            ]);

            $newTicket = new Ticket();
            $newTicket->subject         = $validateData['subject'];
            $newTicket->details         = $request->description;
            $newTicket->assigned_to     = $validateData['assigned_to'];
            $newTicket->priority        = $request->priority;
            $newTicket->save();

            return response()-> json([
                'error' => false,
                'Ticket' => $newTicket,
            ], Response:: HTTP_OK);

        }
        catch(\Exception $error){

            return response()->json([
                'error'                 => true,
                'message'               => 'Hubo un error al crear el ticket. Mensaje: '.$error->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try{

            return response()->json([
                'error' => false,
                'users' => Ticket::findOrFail($id),
            ], Response::HTTP_OK); 

        }
        catch(\Exception $error){

            return response()->json([
                'error' => true,
                'message' => 'Ticket no encontrado',
            ], Response::HTTP_NOT_FOUND); 

    }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
