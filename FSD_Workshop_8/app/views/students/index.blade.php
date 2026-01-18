@extends('layouts.master')
@section('content')
<h2>Students</h2>
<a href="index.php?php?page=create">Add Student</a>
<table>
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>course</th>
		<th>Actions</th>
	</tr>
	@foreach($students as $student)
	<tr>
		<td>{{$student->name}}</td>
		<td>{{$student->email}}</td>
		<td>{{$student->course}}</td>
		<td>
			<a href="index.php?page=edit&id={{$student->id}}">Edit</a>
			<a href="index.php?page=delete&id={{$student->id}}">Delete</a>
		</td>
	</tr>
	@endforeach
</table>
@endsection