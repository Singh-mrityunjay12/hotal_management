@extends('admin.admin_dashboard')
@section('admin')


    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">All Question</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.question') }}" class="btn btn-primary px-5">Add Question</a>

                </div>
            </div>
        </div>
        <!--end breadcrumb-->



        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Sl</th>
                              
                                <th>QTitle</th>
                                <th>Description</th>
                                <th>QAnswer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $key => $question)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    {{-- <td> <img src="{{ asset($question->image) }}" alt=""
                                            style="width:70px; height:40px;"> </td> --}}
                                    <td>{{ $question->title }}</td>
                                    <td>{{ $question->description }}</td>
                                    <td>{{ $question->answer }}</td>
                                    <td>
                                        @if (Auth::user()->can('team.edit'))
                                            <a href="{{ route('edit.question', $question->id) }}"
                                                class="btn btn-warning px-3 radius-30"> Edit</a>
                                        @endif

                                        @if (Auth::user()->can('team.delete'))
                                          
                                            <a href="{{route('delete.question', $question->id)}}"
                                                class="btn btn-danger px-3 radius-30" id="delete"> Delete</a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <hr />

    </div>
@endsection


