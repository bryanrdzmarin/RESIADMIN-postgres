<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;




class UserController extends Controller
{
    //Mostrar todas los usuarios 
    public function index (){
        $users =User::orderBy('id', 'desc')->paginate();
        return view ('admin.usuarios.index',compact('users'));
    }

    //Mostrar formulario para crear nuevo usuario
    public function create ()
    {
        $roles=Role::all();
        return view('admin.usuarios.create', compact('roles'));
    } 

    //Guardar un  nuevo usuario en la bd
    public function store(Request $request)
    {
        $user = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'roles' => ['required', 'exists:roles,id'],
        ]);

        $user1 = User::create([
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => bcrypt($user['password']),
        ]);

        $rol = Role::findOrFail($request->roles);
        $user1->assignRole($rol->name);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Usuario creado!',
            'text' => 'El usuario se ha creado correctamente',
            'confirmButtonText' => 'Aceptar',
            'confirmButtonColor' => '#059669',
            'iconColor' => '#059669',
        ]);

        return redirect()->route('admin.usuarios.index');
    }

    //Mostrar el formulario para editar un usuario
    public function edit (User $user)
    {
        $roles=Role::all();
        return view('admin.usuarios.edit', compact('user','roles'));
    }

    //Guardar los cambios de un usuario editado 
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Excluir el email del propio usuario
            ],
            'roles' => ['required', 'exists:roles,id'], // Asegura que se seleccione un rol válido
            'password' => ['nullable', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        // Actualizar los datos básicos
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if ($validated['password']) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        // Actualizar roles (asumimos que solo puede tener 1)
        $role = Role::findOrFail($validated['roles']);
        $user->syncRoles([$role->name]);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Usuario editado!',
            'text' => 'El usuario se ha editado correctamente',
            'confirmButtonText' => 'Aceptar',
            'confirmButtonColor' => '#059669',
            'iconColor' => '#059669',
        ]);

        return redirect()->route('admin.usuarios.index');
    }


    //Mostrar una residencias que coincidan con un dato
    public function show(Request $request)
    {
        $busqueda= $request->busqueda;
        $users = User::where(function ($query) use ($busqueda) {
            $query->where('name', 'like', "%{$busqueda}%")
                ->orWhere('email', 'like', "%{$busqueda}%")
                ->orWhereHas('roles', function ($q) use ($busqueda) {
                    $q->where('name', 'like', "%{$busqueda}%");
                });
        })->paginate();


        return view ('admin.usuarios.index',compact('users', 'busqueda'));
    }


    //Eliminar usuario 
    public function destroy(User $user)
    {
        try {

            $currentUser = Auth::user(); // O también auth()->user()
            if ($currentUser && $user->id === $currentUser->id) {
            session()->flash('swal', [
                        'icon' => 'warning',
                        'title' => 'No se puede eliminar',
                        'text' => 'No puedes eliminar tu propia cuenta.',
                        'confirmButtonText' => 'Aceptar',
                        'confirmButtonColor' => '#F59E0B', 
                        'iconColor' => '#F59E0B'
                    ]);

                return redirect()->route('admin.usuarios.index');
            }

            // Verificamos si tiene el rol "Admin" (con mayúscula)
            // Verifica si el usuario tiene el rol "Admin"
            if ($user->getRoleNames()->contains('Admin')) {
                // Buscar si existe al menos otro usuario con rol Admin (excepto este)
                $adminUsers = User::where('id', '!=', $user->id)->get();

                $otrosAdmins = $adminUsers->filter(function ($u) {
                    return $u->getRoleNames()->contains('Admin');
                });

                if ($otrosAdmins->count() === 0) {

                    session()->flash('swal', [
                        'icon' => 'warning',
                        'title' => 'No se puede eliminar',
                        'text' => 'Este es el único usuario con rol Admin. Debes asignar otro antes de eliminarlo.',
                        'confirmButtonText' => 'Entendido',
                        'confirmButtonColor' => '#F59E0B',
                        'iconColor' => '#F59E0B',
                    ]);

                    return redirect()->route('admin.usuarios.index');
                }
            }


            // Limpia manualmente relaciones en las tablas pivot
            DB::table('model_has_roles')->where('model_id', $user->id)->delete();
            DB::table('model_has_permissions')->where('model_id', $user->id)->delete();

            // Borrar el usuario directamente desde SQL por si Eloquent falla
            DB::table('users')->where('id', $user->id)->delete();

            session()->flash('swal', [
                'icon' => 'success',
                'title' => 'Usuario eliminado!',
                'text' => 'El usuario ha sido eliminado de la base de datos.',
                'confirmButtonText' => 'Aceptar',
                'confirmButtonColor' => '#059669',
                'iconColor' => '#059669',
            ]);
        } catch (\Throwable $e) {
            session()->flash('swal', [
                'icon' => 'error',
                'title' => 'Error al eliminar',
                'text' => 'Algo impidió eliminar al usuario: ' . $e->getMessage(),
                'confirmButtonText' => 'Entendido',
                'confirmButtonColor' => '#DC2626',
                'iconColor' => '#DC2626',
            ]);
        }

        return redirect()->route('admin.usuarios.index');
    }

    
}
