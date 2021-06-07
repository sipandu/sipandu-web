<?php

namespace App\Http\Controllers;

use App\Command;
use Illuminate\Http\Request;

class BotCommandControllerStatic extends Controller
{
    public function index()
    {
        $command = Command::where('is_full_edited', '!=', '1')->where('is_main_fitur', '1')->get();
        return view('pages.admin.bot-command.pertanyaan-satu-arah.home', compact('command'));
    }

    public function edit($id)
    {
        $command = Command::find($id);
        return view('pages.admin.bot-command.pertanyaan-satu-arah.edit', compact('command'));
    }

    public function update(Request $request, $id)
    {
        $command = Command::find($id);
        $command->chat = $request->chat;
        $command->desc_fitur = $request->desc_fitur;
        $command->save();
        return redirect()->back()->with(['success' => 'Data berhasil diupdate']);
    }

    public function indexChild($id)
    {
        $command = Command::where('is_full_edited', '!=', '1')->where('parent_id', $id)->get();
        return view('pages.admin.bot-command.pertanyaan-satu-arah.child.home', compact('command'));
    }

    public function editChild($id)
    {
        $command = Command::find($id);
        return view('pages.admin.bot-command.pertanyaan-satu-arah.child.edit', compact('command'));
    }
}
