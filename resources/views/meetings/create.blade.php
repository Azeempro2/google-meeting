@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Google Meeting</h1>
        <form method="POST" action="{{ route('google-meetings.store') }}">
            @csrf
            <div class="form-group">
                <label for="subject">Subject:</label>
                <input type="text" class="form-control" id="subject" name="subject" value="{{@$item->subject ?? ''}}" required>
            </div>
            <div class="form-group">
                <label for="subject">Description:</label>
                <input type="text" class="form-control" id="subject" name="description" value="{{@$item->description ?? ''}}" required>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date & Time:</label>
                <input type="datetime-local" class="form-control" id="start_date" name="start_date" value="{{@$item->start_date ?? ''}}" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date & Time:</label>
                <input type="datetime-local" class="form-control" id="end_date" name="end_date" value="{{@$item->end_date ?? ''}}" required>
            </div>
            @isset($item)
                <div class="form-group">
                    <label for="end_date">Joining Link:</label>
                    <input type="text" class="form-control" id="join_link" name="join_link" value="{{@$item->join_link ?? ''}}" disabled>
                </div>
            @endisset

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
