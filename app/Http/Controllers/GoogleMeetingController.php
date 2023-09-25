<?php

namespace App\Http\Controllers;

use App\Models\GoogleMeeting;
use App\Models\MeetingAttendee;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;

class GoogleMeetingController extends Controller
{
    // Display a list of meetings
    public function index()
    {
        $googleMeetings = GoogleMeeting::paginate(10);
        return view('meetings.index', compact('googleMeetings'));
    }

    // Show the form for creating a new meeting
    public function create()
    {
        $users = User::all();
        return view('meetings.create', compact('users'));
    }

    // Store a newly created meeting in the database
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:256',
            'start_time' => 'required',
            'end_time' => 'required',
            'participants' => 'nullable|array'
        ]);
        //create a new event
        $event = new Event();

        $event->name = $request->start_time;
        $event->description = $request->start_time;
        $event->startDateTime = $request->start_time;
        $event->endDateTime = $request->end_time;
        $event->addAttendee([
            'email' => 'azeempro2@gamil.com',
            'name' => 'John Doe',
            'comment' => 'Lorum ipsum',
        ]);
        $event->addAttendee(['email' => 'waqasazam372@gmail.com']);
        $event->addMeetLink();
        $event->save();

        $this->input['event_id'] = $event->id;
        $this->input['join_link'] = $event->htmlLink;

        $meeting = GoogleMeeting::create($this->input);

        return redirect()->route('meetings.index')->with('success', 'Meeting created successfully.');
    }

    // Show the form for editing the specified meeting
    public function edit(GoogleMeeting $item)
    {
        return view('meetings.create', compact('item'));
    }

    // Update the specified meeting in the database
    public function update(Request $request, GoogleMeeting $meeting)
    {
        $event = Event::find($meeting->event_id);
        $event->update(['name' => $this->input['subject']]);

        $meeting->update($this->input);

        return redirect()->route('meetings.index')->with('success', 'Meeting updated successfully.');
    }

    // Remove the specified meeting from the database
    public function destroy(GoogleMeeting $meeting)
    {
        $event = Event::find($meeting->event_id);
        $event->delete();

        $meeting->delete();
        return redirect()->route('meetings.index')->with('success', 'Meeting deleted successfully.');
    }
}
