<?php

namespace App\Http\Controllers\Api;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function createNote(Request $request){
        $note = new Note();
        $note->user_id = Auth::user()->id;
        $note->ticket_id = $request->ticket_id;
        $note->note = $request->text;

        $note->save();

        return $note;
    }

    public function getNotes($ticket_id){

        $notes = Note::with('user')->where('ticket_id', $ticket_id)->get();

        return $notes;

    }
}
