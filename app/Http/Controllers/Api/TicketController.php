<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\TicketCreated;
use Illuminate\Support\Facades\Auth;
use App\Notifications\RemovedFromTicket;

class TicketController extends Controller
{

    public function getTickets($project_id, $user_id){
        $project = Project::find($project_id);
        $user = User::find($user_id);

        $tickets = Ticket::where('project_id', $project->id);

        $userTickets = $tickets
                        ->with('users')
                        ->whereHas('users', function($query) use ($user_id){
                            $query->where('user_id', $user_id);
                        })->get();
        
        return $userTickets;
    }


    //Show Ticket
    public function getTicket($ticket_id){
        $ticket = Ticket::with('users')->with('notes')->where('id', $ticket_id)->first();
        return $ticket;
    }

    // Get tickets for a specific user
    public function getUserTickets($user_id){
        return Ticket::with('users')->whereHas('users', function($query) use($user_id){
        $query->where('user_id', '=', $user_id);
    })->get();
    }


    //Creates a new tickets for a specific user
    public function createTicket(Request $request){
        $ticket = new Ticket();
        $ticket->project_id = $request->project_id;
        $ticket->title = $request->title;
        $ticket->description = $request->description;
        $ticket->save();
        $user_id = Auth::user()->id;

        $ticket->users()->attach($user_id);
        
        //if user who is creating the ticket is not the CEO, attach CEO to this ticket

        if(Auth::user()->role_id != 1){
            $ticket->users()->attach(1);
        }

        return $ticket;
    }

    public function assignDeveloper(Request $request){
        $ticket = Ticket::findOrFail($request->ticket_id);
        $ticket->users()->attach($request->developer_id);

        //notifying the assigned developer about the ticket he is assigned to
        $developer = User::find($request->developer_id);
        $project = $ticket->project;
        $message = "You are assigned to a new ticket for '" . $project->name . "'!";
        $developer->notify(new TicketCreated($message, $project, $request->ticket_id));

        return $ticket;
    }

     public function removeDeveloper(Request $request){
        $ticket = Ticket::findOrFail($request->ticket_id);
        $ticket->users()->detach($request->developer_id);

        //notify the developer that he is removed from ticket
        $developer = User::find($request->developer_id);
        $message = "You are removed from a ticket - " . $ticket->title . " in " . $ticket->project->name;

        $developer->notify(new RemovedFromTicket($message));


        return $ticket;
    }
}
