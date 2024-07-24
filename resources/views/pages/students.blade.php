@extends('layouts.header') 

@section('content')
@include('modals.student-create')

    <div class="flex justify-between mb-4 shadow-md p-2 bg-gray-200 items-center">
        <div class="flex items-center">
        <button title="click me to open sidebar" onclick="sidebar.classList.toggle('-translate-x-full')"
    class="py-1 px-3 bg-gray-500 text-xl m-2 hover:bg-gray-800 text-white shadow-md rounded">III</button>
        <h1 class="text-2xl font-semibold">Students List</h1>
        </div>
    
        <button onclick="document.getElementById('student-create').classList.remove('hidden')" class="px-2 py-2 bg-blue-500 hover:bg-blue-800 text-blue-100 rounded">Add Student</button>
    </div>


<div id="students-list" class="grid grid-cols-3 gap-3 min-h-auto w-full p-6">
    
       @include('inclusions.students-list' )


<div id="student"></div>


@endsection