<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserController extends Controller
{
    public function completarCadastro()
    {
        $usuario = Auth::user();

        return view("usuario.completarCadastro", ['usuario' => $usuario]);
    }

    public function completar(Request $request)
    {
        $user = User::find($request->id_usuario);

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users'],
            'cpf' => ['required', 'unique:users'],
            'username' => ['required', 'string', 'max:255'],
            'telefone' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $validator->sometimes('username', 'unique:users', function ($request) use ($user) {
            return $request->username != $user->username;
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->cpf = $request->cpf;
        $user->username = $request->username;
        $user->telefone = $request->telefone;
        $user->password = Hash::make($request->password);
        $user->cadastrado = true;

        $user->update();

        return redirect()->route("aluno.listar")->with('success', 'Seu cadastro está completo!.');
    }

    public function editar()
    {
        $usuario = Auth::user();

        return view("usuario.editar", ['usuario' => $usuario]);
    }

    public function editarSenha()
    {
        return view('usuario.editarSenha');
    }

    public static function atualizar(Request $request)
    {
        $usuario = Auth::user();

        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'cpf' => ['required'],
            'username' => 'required|string|max:255',
            'telefone' => 'required|string',
            'name' => 'required|string|max:255',
            'senha' => 'required|string|min:6',
        ]);

        $validator->sometimes('username', 'unique:users', function ($request) use ($usuario) {
            return $request->username != $usuario->username;
        });

        $validator->sometimes('email', 'unique:users', function ($request) use ($usuario) {
            return $request->email != $usuario->email;
        });

        $validator->sometimes('cpf', 'unique:users', function ($request) use ($usuario) {
            return $request->cpf != $usuario-cpf;
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        if (!(Hash::check($request->senha, $usuario->password))) {
            return redirect()->back()->with('fail', 'Senha incorreta.');
        }

        $usuario->name = $request->name;
        $usuario->username = $request->username;
        $usuario->email = $request->email;
        $usuario->cpf = $request->cpf;
        $usuario->telefone = $request->telefone;

        $usuario->update();

        return redirect()->route("aluno.listar")->with('success', 'Seus dados foram atualizados!');
    }


    public static function atualizarSenha(Request $request)
    {
        $usuario = Auth::user();

        if (!(Hash::check($request->senha_atual, $usuario->password))) {
            return redirect()->back()->with('fail', 'Senha atual incorreta.');
        }

        if ($request->nova_senha != $request->nova_senha_confirm) {
            return redirect()->back()->with('fail', 'Nova senha e confirmação são diferentes.');
        }

        $validator = Validator::make($request->all(), [
            'nova_senha' => 'min:6|max:16'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $usuario->password = bcrypt($request->nova_senha);
        $usuario->update();

        return redirect()->route("aluno.listar")->with('success', 'Sua senha foi atualizada!');
    }
}
