@extends('layouts.admin')

@section('content')
<div class="container">

    <h2 class="mb-4">Messages</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
     <div class="table-responsive">
         <table class="table table-bordered text-center ">
             <thead class="table-dark">
                 <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Subject</th>
                     <th>Message</th>
                     <th>Action</th>
                 </tr>
             </thead>
             <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->subject }}</td>
                        <td>{{ $contact->message }}</td>
                        <td>
                            <a href="mailto:{{ $contact->email}}" class="btn btn-success">Response</a>
                        </td>
                    </tr>
                @endforeach
             </tbody>
         </table>
     </div>
</div>
<script src="{{ asset('bootstrap.bundle.js') }}"></script>
@endsection