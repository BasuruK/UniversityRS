@extends('beautymail::templates.ark')

@section('content')

    <h1 style="background-color: slategray; color:white; text-align: center">University<b>RS</b></h1>
    @include('beautymail::templates.ark.heading', [
        'heading' => 'Deadline Notification',
        'level' => 'h1'
    ])

    @include('beautymail::templates.ark.contentStart')

    <h4 class="secondary"><strong>Reminder !</strong></h4>
    <p>This is to notify you that Deadline for requesting time slot allocations for semester {{ $semester }} for year {{ $year }} is on {{ $date }}</p>

    @include('beautymail::templates.ark.contentEnd')

@stop