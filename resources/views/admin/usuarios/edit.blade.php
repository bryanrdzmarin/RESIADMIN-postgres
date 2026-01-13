<x-layouts.app >

    <flux:breadcrumbs class="mb-4">
        <flux:breadcrumbs.item href="{{ route('admin.usuarios.index') }}">Usuarios</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>Editar</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <div class="card">
        <form action="{{ route('admin.usuarios.update', [$user->id]) }}" method="POST"  class="space-y-2">

            @csrf
            @method('PUT')

            <flux:input label="Nombre y Apellidos:" type="text" name="name" required value="{{old('name', $user->name)}}" />
            <flux:input label="Correo electrónico:" type="text" name="email" required value="{{old('email', $user->email)}}"/>
            <flux:input label="Contraseña:" type="password" name="password" autocomplete="new-password" />
            <flux:input label="Confirmar contraseña:" type="password" name="password_confirmation" autocomplete="new-password" />
           <flux:label>Roles</flux:label>
           <flux:select name="roles" class="w-full bg-white appearance-none mt-2" required>
                @foreach ($roles as $rol)
                    <option 
                        value="{{ $rol->id }}"
                        {{ (old('roles') ? old('roles') == $rol->id : $user->roles->first()?->id == $rol->id) ? 'selected' : '' }}
                    >
                        {{ $rol->name }}
                    </option>
                @endforeach
            </flux:select>
            
            <div class="flex justify-end space-x-3 mt-4 mr-8">
                <flux:button variant="primary" type="submit">Guardar</flux:button>
                <a href="{{route('admin.usuarios.index')}}" class="flux-button flux-button-primary" style="background-color: black !important; color: white !important; padding: 0.5rem 1rem; border-radius: 0.5rem; display: inline-block; text-align: center; font-size: inherit; line-height: 1.5; transition: background-color 0.3s ease-in-out;">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
   

</x-layouts.app>