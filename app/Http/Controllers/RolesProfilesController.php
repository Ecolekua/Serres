<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;
use Alert;
class RolesProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public $nombre;
    public function index()
    {
        $roles=role::paginate();
        return view('RolesProfiles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('RolesProfiles.create',compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->name);
        $buscar=role::where('name',$request->name)->get();
        //dd($buscar);
        foreach($buscar as $dato){
            $this->nombre = $dato->name;
        }

        if(empty($this->nombre))
        {
            $role = Role::create($request->all());
            $role->permissions()->sync($request->get('permissions'));
            Alert::success('Rol Guardado con Exito');
            return redirect()->route('rolesprofiles.edit',$role->id);
        }else{
            Alert::error('Nombre de Perfil en Uso');
            return back();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $permissions = Permission::get();
        return view('RolesProfiles.show',compact('role','permissions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::get();
        return view('RolesProfiles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->update($request->all());
        $role->permissions()->sync($request->get('permissions'));
        Alert::success('Rol Actualizado con Exito');
        return redirect()->route('rolesprofiles.edit',$role->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $borrar=Role::where('id',$id)->delete();
        return ;
    }
}
