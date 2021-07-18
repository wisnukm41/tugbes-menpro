<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'title' => 'Daftar Pesan',
            'messages' => Message::all(),
        ];
        return view('admin.messages.messages-list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'title' => 'Contact Us',
        ];
        return view('user.messages',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Message::create([
            'name' => request('name'),
            'email' => request('email'),
            'contact' => request('contact'),
            'title' => request('title'),
            'description' => request('description'),
        ]);

        return redirect()->route('user-messages')->with('success','Message Sent Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        $message->new = 0;
        $message->save();

        $data = [
            'title' => "Lihat Pesan | ".$message->title,
            'message' => $message,
            'id' => $message->id
        ];
        return view('admin.messages.message-show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();

        return redirect()->route('admin-messages')->with('success','Pesan Berhasil Dihapus');
    }

    public function destroy_read()
    {
        $messages = Message::where('new',0)->delete();

        return redirect()->route('admin-messages')->with('success','Pesan Terbaca Berhasil Dihapus');
    }
}
