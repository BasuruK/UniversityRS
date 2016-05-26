@extends('layouts')

@section('content')

    <button id="btnAdd" onclick="/subject/new">Add Subject</button>
    <table>
        <tr>
            <th>
                <td>subject Code</td>
                <td>subject Name</td>
                <td>Semester</td>
                <td>Year</td>       
            </th>
        </tr>
        @foreach($subjects as $subject)
            <tr>
                <td>{{$subject->subCode}}</td>
                <td>{{$subject->subName}}</td>
                <td>{{$subject->semester}}</td>
                <td>{{$subject->year}}</td>
                <td><button id="btnEdit" onclick="/subject/edit/{{$subject->id}}">Edit</button></td>
                <td><button id="btnDelete" onclick="/subject/delete/{{$subject->id}}">Delete</button></td>
            </tr>
        @endforeach
            
    </table>

@stop