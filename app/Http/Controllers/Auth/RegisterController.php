<?php

namespace sldb\Http\Controllers\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use sldb\Models\User;
use sldb\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/painel';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:tb_usuario',
            'dataNascimento' => 'required|date_format:d/m/Y',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'O campo :attribute é obrigatório',
            'email.required' => 'O campo :attribute é obrigatório',
            'email.unique' => 'O :attribute informado já está cadastrado',
            'email.email' => 'Favor informar um email válido',
            'password.required' => 'O campo :attribute é obrigatório',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres',
            'password.confirmed' => 'As senhas digitadas são diferentes',
            'dataNascimento.date' => 'A data de nascimento deve ser válida! Formato dd/mm/aaaa'
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $dataNascimento = explode("/", $request['dataNascimento']);

        $year = $dataNascimento[2];
        $month = $dataNascimento[1];
        $day = $dataNascimento[0];

        $idadeUsuario = Carbon::now()->diffInYears(Carbon::createFromDate($year, $month, $day));

        if($idadeUsuario<18) {
            Session::flash("dataNascimento", "E necessario ser maior de 18 anos para se cadastrar em nosso sistema");
            return back()->withInput();
        }

        $request['dataNascimento'] = Carbon::createFromDate($year, $month, $day);

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        if($request['perfil_id'] == '2') //se for o cadastro de um novo cliente direciona pra home do site
            $this->redirectTo = '/';

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \sldb\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'cpf' => $data['cpf'],
            'data_nascimento' => $data['dataNascimento'],
            'telefone' => $data['telefone'],
            'perfil_id' => $data['perfil_id']
        ]);
    }

}
