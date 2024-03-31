<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Mail\RegisterMail;
use LaravelVueGoodTable\InteractsWithVueGoodTable;
use LaravelVueGoodTable\Columns\Column;
use LaravelVueGoodTable\Columns\Number;
use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    /**
     * Get the query builder
     *
     * @param Request $request
     *
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function exportUsersToJson()
    {
        $users = User::all();
        $json = json_encode($users, JSON_PRETTY_PRINT);

        $path = storage_path('app/users.json');
        File::put($path, $json);

        return response()->download($path);
    }
    public function index(Request $request)
    {
        $datas = User::get()->sortBy('created_at');
        return view('user.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $password = Hash::make('password');
        $data = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'ktp_no' => $request->get('ktp_no'),
            'addres' => $request->get('addres'),
            'phone_number' => $request->get('phone_number'),
            'password' => $password
        ]);

        Mail::to($data['email'])->send(new RegisterMail($data));

        alert()->success('Berhasil.', 'Data telah ditambahkan!');

        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = User::findOrFail($id);

        return view('user.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $user = User::all();
        $data = User::findOrFail($id);
        return view('user.edit', compact('data', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $password = Hash::make('password');
        User::find($id)->update([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'ktp_no' => $request->get('ktp_no'),
            'addres' => $request->get('addres'),
            'phone_number' => $request->get('phone_number'),
        ]);

        alert()->success('Berhasil.', 'Data telah diubah!');
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        alert()->success('Berhasil.', 'Data telah dihapus!');
        return redirect()->route('user.index');
    }
}
