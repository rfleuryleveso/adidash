@extends('layouts.app')

@section('title', 'Calendrier')

@section('page_name', 'Calendrier')

@section('content')
    <div id="calendar">
    </div>
@endsection

@push('scripts')
    <script src="/dist/js/calendar.js"></script>
@endpush
