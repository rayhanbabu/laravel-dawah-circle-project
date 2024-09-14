@extends('frontend/headerhome')
@section('page_title','Admin Dashboard')
@section('login','active')
@section('homecontent')

<style>
  .card-img-hover:hover {
    transform: scale(1.1); /* Zoom effect */
    filter: brightness(0.8); /* Slightly darken the image */
  }
</style>


<div class="container my-5">
<form action="{{ url('/book') }}" method="GET" class="mb-4">
    <div class="input-group">
      <input type="text" name="search" class="form-control" placeholder="Search Book..." value="{{ $search }}">
      <button type="submit" class="btn btn-primary">Search</button>
    </div>
  </form>

  <!-- Cards Grid -->
  <div class="row">
    @foreach ($book as $row)
      <div class="col-md-3 p-2">
        <div class="card border p-1 shadow-sm h-100">
          <div class="card-img-wrapper" style="overflow: hidden;">
            <img
              src="{{ !empty($row->image) ? asset('uploads/admin/' . $row->image) : asset('/frontend/img/bookicon.png') }}"
              class="d-block mx-auto card-img-hover"
             
              style="height: 220px; width: auto; transition: transform 0.3s ease, filter 0.3s ease;"
            />
          </div>
          <div class="card-body">
            <h5 class="card-title text-center">{{ $row->title }}</h5>
            <p class="card-text text-center">
              <a href="{{url('book_detail/'.$row->book_code)}}" class="btn btn-primary"> বিস্তারিত দেখুন  </a>
            </p>
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <!-- Pagination Links -->
  <div class="d-flex justify-content-center mt-4">
    {{ $book->appends(['search' => $search])->links() }}
  </div>

  </div>


@endsection

