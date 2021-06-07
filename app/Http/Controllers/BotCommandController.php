<?php

namespace App\Http\Controllers;

use App\Command;
use Illuminate\Http\Request;

class BotCommandController extends Controller
{
    public function index()
    {
        $command = Command::where('model', 'KonsultasiCommand::class')
            ->where('is_question', '1')
            ->where('is_full_edited', '1')
            ->get();
        return view('pages.admin.bot-command.pertanyaan-konsultasi.home', compact('command'));
    }

    public function create()
    {
        $command = Command::where('model', 'KonsultasiCommand::class')->where('is_question', '1')->get();
        return view('pages.admin.bot-command.pertanyaan-konsultasi.create', compact('command'));
    }

    public function store(Request $request)
    {
        $pertanyaan = new Command();
        $pertanyaan->command = $request->command_pertanyaan;
        $pertanyaan->type = 'sendMessage';
        $pertanyaan->model = 'KonsultasiCommand::class';
        $pertanyaan->parent_id = $request->parent_id;
        $pertanyaan->chat = $request->chat_pertanyaan;
        $pertanyaan->method = 'ask'.$request->key;
        $pertanyaan->key = $request->key;
        $pertanyaan->is_question = '1';
        $pertanyaan->id_full_edited = '1';
        $pertanyaan->is_answer = '0';
        $pertanyaan->satuan = $request->satuan ?? '-';
        $pertanyaan->save();

        $jawaban = new Command();
        $jawaban->command = $request->command_jawaban;
        $jawaban->type = 'sendMessage';
        $jawaban->model = 'KonsultasiCommand::class';
        $jawaban->parent_id = $pertanyaan->id;
        $jawaban->chat = $request->chat_jawaban;
        $jawaban->method = 'store'.$request->key;
        $jawaban->key = $request->key;
        $jawaban->is_question = '0';
        $jawaban->id_full_edited = '1';
        $jawaban->is_answer = '1';
        $jawaban->is_numeric = $request->is_numeric;
        $jawaban->satuan = $request->satuan ?? '-';
        $jawaban->save();

        return redirect()->route('pertanyaan-konsultasi.home')->with(['success' => 'Data berhasil ditambahkan']);
    }

    public function show($id)
    {
        $pertanyaan = Command::find($id);
        $jawaban = Command::where('parent_id', $id)->first();
        $command = Command::where('model', 'KonsultasiCommand::class')->where('is_question', '1')->get();
        return view('pages.admin.bot-command.pertanyaan-konsultasi.edit', compact('command', 'jawaban', 'pertanyaan'));
    }

    public function update(Request $request, $id)
    {
        $pertanyaan = Command::find($id);
        $pertanyaan->command = $request->command_pertanyaan;
        $pertanyaan->chat = $request->chat_pertanyaan;
        $pertanyaan->method = 'ask'.$request->key;
        $pertanyaan->key = $request->key;
        $pertanyaan->satuan = $request->satuan ?? '-';
        $pertanyaan->save();

        $jawaban = Command::where('parent_id', $id)->first();
        $jawaban->command = $request->command_jawaban;
        $jawaban->chat = $request->chat_jawaban;
        $jawaban->method = 'store'.$request->key;
        $jawaban->key = $request->key;
        $jawaban->is_numeric = $request->is_numeric ?? '0';
        $jawaban->satuan = $request->satuan ?? '-';
        $jawaban->save();

        return redirect()->route('pertanyaan-konsultasi.home')->with(['success' => 'Data berhasil diubah']);
    }

    public function kosongkanParent($id)
    {
        $pertanyaan = Command::find($id);
        $pertanyaan->parent_id = NULL;
        $pertanyaan->save();
        return redirect()->route('pertanyaan-konsultasi.home')->with(['success' => 'Parent berhasil dikosongkan']);
    }

    public function addParent(Request $request)
    {
        $command = Command::find($request->id);
        $command->parent_id = $request->parent_id;
        $command->save();
        return redirect()->route('pertanyaan-konsultasi.home')->with(['success' => 'Parent berhasil ditambahkan']);
    }

    public function delete(Request $request)
    {
        $command = Command::find($request->id);
        $command->delete();

        $child = Command::where('parent_id', $request->id)->first();

        $grandchild = Command::where('parent_id', $child->id)->first();
        $grandchild->parent_id = NULL;
        $grandchild->save();

        $child->delete();

        return redirect()->route('pertanyaan-konsultasi.home')->with(['success' => 'Data berhasil dihapus']);
    }
}
