<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'error' => false,
            'users' => User::all(),
            ], Response::HTTP_CREATED);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(CreateUserRequest $request)
    {
        try{
            $newUser = User::create($request->safe()->only([
                'name',
                'email',
                'last_name',
                'phone_number',
                'password'
            ]));
            return response()->json([
                'error' => false,
                'user'  => $newUser,
            ], Response::HTTP_CREATED);
        }catch(\Exception $error){

            return response()->json([
                'error'     => true,
                'message'   => 'Hubo un error al crear el usuario. Mensaje : '.$error->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $messages = [
                'name.alpha:ascii'      =>  'El nombre del usuario solo acepta caracteres de la A-Z',
                'name.required'         =>  'El nombre del usuario es obligatorio',
                'confirm_Email.same'    =>  'Los email no coinciden'
            ];

            $validator = Validator::make($request->all(), [
                'name'             => 'required|alpha:ascii',
                'last_name'        => 'required',
                'phone_number'     => 'required',
                'email'            => 'required|unique:App\Models\User, email',
                'confirm_email'    => 'required|same:email',
                'password'         => 'required',
                'confirm_password' => 'required|same:password',
            ], $messages);

            if ($validator->fails()){
                return response()->json([
                    'error' =>true,
                    'message' => 'Hubo un error al crear el usuario.'
                ], Response:: HTTP_BAD_REQUEST);
            }

            $validatedData = $validator->safe()->only([
                'name',
                'email',
                'last_name',
                'phone_number',
                'password'
            ]);

            $newUser = new User();
            $newUser -> name = $validatedData['firstName'];
            $newUser -> last_name = $validatedData['lastName'];
            $newUser -> phone_number = $validatedData['phone_number'];
            $newUser -> password = bcrypt($validatedData['password']);

            $newUser -> save();

            return response()-> json([
                'error' => false,
                'user' => $newUser,
            ], Response:: HTTP_OK);
        }
        
        catch(\Exception $error){
            return response()->json([
                'error'     => true,
                'message'   => 'Hubo un error al crear el usuario. Mensaje : '.$error->getMessage()
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
            'users' => User::findOrFail($id),
            ], Response::HTTP_OK); 
        }catch(\Exception $error){
            return response()->json([
                'error' => true,
                'message' => 'Usuario no encontrado',
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