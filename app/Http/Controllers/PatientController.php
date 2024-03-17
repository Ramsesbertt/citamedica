<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PatientController extends Controller
{
    public function index()
    {
        $patients = User::patients()->get(); 
        return view('patients.index', compact('patients'));
    }


    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula' => 'required|digits:10',
            'address' => 'nullable|min:6',
            'phone' => 'required',
        ];
        $massages = [
            'name.required' => 'El nombre del médico es obligatorio',
            'name.min' => 'El nombre del paciente debe tener mas de 3 caracteres',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'Ingresar una dirección de correo electrónico válido',
            'cedula.required' => 'La cédula es obligatoria',
            'cedula.digits' => 'La cédula debe tener mas de 10 dígitos',
            'address.min' => 'La dirección debe tener almenos 6 caracteres',
            'phone.required' => 'El número del teléfono es obligatorio',

        ];
         
        $this->validate($request, $rules, $massages);

        User::create(
            $request->only('name','email','cedula','address','phone')
            + [
                'role' => 'paciente',
                'password' => bcrypt($request->input('password'))
            ]
        );
        $notification = 'El paciente se ha registrado correctamente.';
        return redirect('/pacientes')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $patient = User::Patients()->findOrFail($id);
        return view('patients.edit', compact('patient'));
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'cedula' => 'required|digits:10',
            'address' => 'nullable|min:6',
            'phone' => 'required',
        ];
        $massages = [
            'name.required' => 'El nombre del paciente es obligatorio',
            'name.min' => 'El nombre del paciente debe tener mas de 3 caracteres',
            'email.required' => 'El correo electrónico es obligatorio',
            'email.email' => 'Ingresar una dirección de correo electrónico válido',
            'cedula.required' => 'La cédula es obligatoria',
            'cedula.digits' => 'La cédula debe tener mas de 10 dígitos',
            'address.min' => 'La dirección debe tener almenos 6 caracteres',
            'phone.required' => 'El número del teléfono es obligatorio',

        ];
         
        $this->validate($request, $rules, $massages);
        $user = User::Patients()->findOrFail($id);

        $data = $request->only('name','email','cedula','address','phone');
        $password = $request->input('password');

        if($password)
            $data['password'] = bcrypt($password);

        $user->fill($data);
        $user->save();

        $notification = 'La información del paciente se ha actualizo correctamente.';
        return redirect('/pacientes')->with(compact('notification'));
    }

    public function destroy($id)
    {
        $user = User::Patients()->findOrFail($id);
        $PacienteName = $user->name;
        $user -> delete();

        $notification = "El médico $PacienteName se elimino correctamente";

        return redirect('/pacientes')->with(compact('notification'));
    }
}
