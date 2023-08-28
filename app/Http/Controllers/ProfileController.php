<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Profile;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validate([
            'career' => 'required|max:75',
            'website' => 'max:75',
            'email' => 'email|max:75',
            'author.id' => 'required|integer|exists:authors,id',
        ]);
        
        try{
            $profile = new Profile();
            $profile->career = $request->career;
            $profile->biography = $request->biography;
            $profile->website = $request->website;
            $profile->email = $request->email;
            $profile->author_id = $request->author['id'];
            $profile->save();

            return response()->json(['status' => true,
                                    'message' => 'El perfil del autor '.$profile->author['full_name'].' fue creado con exito']);
        } catch(Exception $exc){
            return response()->json(['status' => true,
                                    'message' => 'Error al crear el registro'.$exc]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $validated = $this->validate([
        'career' => 'required|max:75',
        'website' => 'max:75',
        'email' => 'email|max:75',
        'author.id' => 'required|integer|exists:authors,id',
        ]);

        try{
            $profile = Profile::findOrFail($id);
            $profile->career = $request->career;
            $profile->biography = $request->biography;
            $profile->website = $request->website;
            $profile->email = $request->email;
            $profile->author_id = $request->author['id'];
            $profile->save();
            
            return response()->json(['status' => true,
                                    'message' => 'El perfil del autor '.$profile->author['full_name'].' fue actualziado con exito']);
        } catch(Exception $exc){
            return response()->json(['status' => true,
                                    'message' => 'Error al actualizar el registro'.$exc]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}