@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Google Meetings</h1>
        <a href="{{ route('google-meetings.create') }}" class="btn btn-primary">Add</a>

        <table class="table">
            <thead>
            <tr>
                <th>Subject</th>
                <th>Date & Time</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($googleMeetings as $meeting)
                <tr>
                    <td>{{ $meeting->subject ?? '' }}</td>
                    <td>{{ $meeting->start_date ?? '' }}</td>
                    <td>{{ $meeting->end_date ?? '' }}</td>
                    <td>{{ $meeting->join_link ?? '' }}</td>
                    <td>
                        <a href="{{ route('google-meetings.edit', $meeting->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('google-meetings.destroy', $meeting->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $googleMeetings->links() }}
    </div>
@endsection
