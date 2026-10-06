<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Password as PasswordFacade;
use Illuminate\Support\Facades\DB;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    // Metodos para iniciar sesion
    // Metodo para cargar la vista de iniciar sesion
    public function loginForm(){
        return view('paginas.auth.login');
    }

    // metodo para iniciar sesion
    public function login_auth(Request $request){

        $credentials = $request->validate([
            'usuario' => 'required',
            'password' => 'required',
        ]);

        $loginType = filter_var($credentials['usuario'], FILTER_VALIDATE_EMAIL) ? 'email' : 'usuario';

        if (Auth::attempt([$loginType => $credentials['usuario'], 'password' => $credentials['password']])) {
            
            $user = Auth::user();
            if (!$user->hasVerifiedEmail()) {
                Auth::logout(); 
                return back()->withErrors(['usuario' => 'Debes verificar tu correo electrónico antes de iniciar sesión.',
            ]);
        }

            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'password' => 'Las credenciales no son correctas.',
        ]);

    }

    // Metodo para cerrar sesion
    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    
    // Metodos para recuperar la contraseña
    // Metodo para cargar la vista para recuperar la contraseña
    public function forgot_password(){
        return view('paginas.auth.forgot_password');
    }

    // Metodo para enviar un email para poder recuperar la contraseña
    public function email_password(Request $request){
        $request->validate([
            'email' => 'required|email|exists:usuarios,email',
        ]);

        $status = PasswordFacade::sendResetLink(
            $request->only('email')
        );

        if ($status === PasswordFacade::RESET_LINK_SENT) {
            return back()->with('status', '¡Enlace de recuperación enviado! Revisa tu correo electrónico.');
        }
    
        return back()->withErrors(['email' => 'No se pudo enviar el enlace de recuperación.']);
    
    }

    // Metodo para cargar la vista para introducir la nueva contraseña
    public function reset_password($token)
    {
        return view('paginas.auth.reset_password', ['token' => $token]);
    }

    // Metodo que restablece la contraseña y actualiza por la contraseña nueva
    public function update_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:usuarios,email',
            'password' => 'required|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'No se encontró un usuario con ese correo.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('login_form')->with('status', 'Tu contraseña ha sido actualizada. Ahora puedes iniciar sesión.');
    }

    // Metodos para registrar usuarios
    // Metodo para cargar la vista con el formulario de registro
    public function registerForm()
    {
        return view('paginas.auth.register');
    }

    // Metodo para registrar el usuario y enviar un email de verificacion
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'usuario' => 'required|string|unique:usuarios,usuario|max:255',
            'email' => 'required|email|unique:usuarios,email|max:255',
            'password' => 'required|string|confirmed',
        ]);

        $user = DB::table('usuarios')->insert([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'telefono' => $request->telefono,
            'usuario' => $request->usuario,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => 'cliente',
        ]);

        $user = User::where('email', $request->email)->first();

        event(new Registered($user));

        return redirect()->route('login_form')->with('status', 'Usuario registrado exitosamente. Por favor, verifica tu correo electrónico.');
    }
    
    // Funcion para verificar el email
    public function verify($id, $hash)
    {
        $user = User::findOrFail($id);

        if (hash_equals($hash, sha1($user->email))) {
            $user->markEmailAsVerified();
        }

        return redirect()->route('login_form')->with('status', 'Correo electrónico verificado exitosamente.');
    }

    // Funcion para verificar si el usuario o email ya existen
    public function validarUsuarioEmail(Request $request)
    {
        $request->validate([
            'campo' => 'required|string',
            'tipo' => 'required|in:usuario,email',
        ]);

        if ($request->tipo == 'usuario') {
            $existe = User::where('usuario', $request->campo)->exists();
        } else {
            $existe = User::where('email', $request->campo)->exists();
        }

        return response()->json(['existe' => $existe]);
    }

    // Funcion para obtener los datos del usuario autenticado
    public function userProfile()
    {
        $user = Auth::user();

        // Mostrar el nombre del rol mejor
        $roles = [
            'administrador' => 'Administrador',
            'jefe_taller' => 'Jefe Taller',
            'mecanico' => 'Mecánico',
            'administrativo' => 'Administrativo',
            'cliente' => 'Cliente',
        ];

        $user->rol_nombre = $roles[$user->rol] ?? $user->rol;
        
        return view('paginas.auth.profile', compact('user'));
    }

    // Funcion para cargar la vista para editar el perfil
    public function editProfile()
    {
        $user = Auth::user();
        return view('paginas.auth.edit_profile', compact('user'));
    }

    // Funcion para actualizar el perfil
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'usuario' => 'required|string|max:255|unique:usuarios,usuario,' . $user->id,
            'telefono' => 'required|string|max:15',
        ]);

        $user->nombre = $request->input('nombre');
        $user->direccion = $request->input('direccion');
        $user->ciudad = $request->input('ciudad');
        $user->usuario = $request->input('usuario');
        $user->telefono = $request->input('telefono');

        $user->save();

        return redirect()->route('user_profile')->with('status', 'Perfil actualizado correctamente.');
    }

    // Funcion para cargar la vista de cambiar contraseña
    public function changePassword()
    {
        return view('paginas.auth.change_password');
    }

    // Funcion para actualizar la contraseña
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual es incorrecta.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user_profile')->with('status', 'Contraseña actualizada correctamente.');
    }

    // Funcion para cargar la vista para eliminar el usuario
    public function confirmDelete()
    {
        return view('paginas.auth.confirm_delete_user');
    }

    // Funcion para que el usuario pueda eliminar su cuenta
    public function deleteUser(Request $request)
    {
        $user = Auth::user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login_form')->with('status', 'Tu cuenta ha sido eliminada.');
    }

}
