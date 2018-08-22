<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = \Auth::user()->id;

        // $user = \App\User::with('files')->find($userId)->toArray();

        // dd($user);

        $user = \App\User::with('files')->find($userId);

        return view('home')->with(compact('user'));
    }

    /**
     * Faz o upload de um arquivo
     *
     * @return string
     */
    public function upload()
    {
        // dd(\Request::all());
        /**
         * Request related
         */
        $file = \Request::file('documento');

        $userId = \Request::get('userId');

        /**
         * Storage related
         */
        $storagePath = \storage_path().'/documentos/'.$userId;

        $fileName = $file->getClientOriginalName();

        /**
         * Database related
         */
        $fileModel = new File();
        $fileModel->name = $fileName;

        $user = User::find($userId);
        $user->files()->save($fileModel);

        return $file->move($storagePath, $fileName);
    }

    /**
     * Faz o download o arquivo
     *
     * @return file
     */
    public function download($userId, $fileId)
    {
        // dd(compact('userId', 'fileId'));

        $file = \App\Models\File::find($fileId);

        $storagePath = \storage_path().'/documentos/'.$userId;

        return \Response::download($storagePath.'/'.$file->name);
    }

    /**
     * Exclui o arquivo
     *
     * @return json
     */
    public function destroy($userId, $fileId)
    {
        // dd(compact('userId', 'fileId'));

        $file = \App\Models\File::find($fileId);

        $storagePath = \storage_path().'/documentos/'.$userId;

        $file->delete();

        unlink($storagePath.'/'.$file->name);

        return redirect()->back()->with('success', 'Arquivo removido com sucesso!');
    }
}
