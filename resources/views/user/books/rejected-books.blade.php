@extends('layouts.user')

@section('title', __('dashboard.my_books'))

@section('content')
<div class="books-page">

<div class="container">


{{-- ================= HEADER ================= --}}


<div class="books-header">


<div class="books-header-content">


<div class="row align-items-center">


<div class="col-md-8">


<div class="books-icon">

<i class="fas fa-book"></i>

</div>


<h1 class="books-title">

{{ __('dashboard.my_books') }}

</h1>


<p class="books-subtitle">

{{ __('message.rejected_books_hint') }}

</p>


</div>



<div class="col-md-4 text-md-end">


<a href="{{ route('user.books.create') }}"
class="add-book-btn">


<i class="fas fa-plus-circle"></i>

{{ __('message.add_record') }}


</a>


</div>


</div>


</div>


</div>




{{-- ================= INFO ================= --}}


@php

$rejectedCount = $rejected_books
->where('status','rejected')
->count();

@endphp



@if($rejectedCount > 0)


<div class="warning-card">


<div class="warning-icon">

<i class="fas fa-exclamation-triangle"></i>

</div>


<div>


<h6 class="fw-bold mb-1">

{{ __('message.attention_needed') }}

</h6>


<p class="mb-0 text-muted">

{{ __('message.rejected_count_hint',
['count'=>$rejectedCount]) }}

</p>


</div>


</div>


@endif





{{-- ================= TABLE CARD ================= --}}


<div class="books-card">


<div class="card-header-custom">


<div class="card-title-custom">

<i class="fas fa-times-circle text-danger me-2"></i>

{{ __('message.rejected_books') }}

</div>


<div class="count-pill">


<i class="fas fa-list"></i>

{{ $rejectedCount }}

{{ __('message.total') }}


</div>


</div>