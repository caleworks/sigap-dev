@extends('layouts.public')

@section('search_public')
    <!-- Header-->
    <div class="container my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                <h3 class="mb-5">Kodel Group Integrated Inventory Apps</h3>
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" role="search">
                    <input type="search" class="form-control" placeholder="Search something..." aria-label="Search">
                </form>
                <p class="mt-3">or <a href="{{ url('/') }}">Browse all Items</a></p>
            </div>
            <div class="col-lg-4 overflow-hidden">
                <img class="rounded-lg-3 mb-5" src="{{ url('assets/img/undraw_file_searching_re_3evy(1).svg') }}" alt="" width="100%" >
            </div>
        </div>
    </div>
@endsection
