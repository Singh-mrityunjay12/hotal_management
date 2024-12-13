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
                        <li class="breadcrumb-item active" aria-current="page">All Reviews List </li>
                    </ol>
                </nav>
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

                                <th>Room </th>

                                <th>Reviews</th>
                                <th>Rating</th>
                                <th>User</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $key => $review)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td> {{ $review->room->type->name }} </td>
                                    <td>{{ $review->review }}</td>
                                    <td>{{ $review->rating }}</td>
                                    <td>{{ $review->user->name }}</td>

                                    <td>
                                        @if ($review->status === 1)
                                         {{-- here status type is int  --}}
                                            <div class="form-check form-switch">
                                        
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" role="switch" checked
                                                        name="custom-switch-checkbox" data-id={{ $review->id }}
                                                        class="form-check-input change-status">
                                                    <span class="custom-switch-indicator"></span>
                                                    {{-- <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault1" checked=""> --}}
                                                </label>
                                            </div>
                                        @else
                                            <div class="form-check form-switch">
                                                <label class="custom-switch mt-2">
                                                    <input type="checkbox" name="custom-switch-checkbox"
                                                        data-id={{ $review->id }} role="switch"
                                                        class="form-check-input change-status">
                                                    <span class="custom-switch-indicator"></span>
                                                </label>
                                            </div>
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





    @push('scripts')
        {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}


        <script>
            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },

                });

                $('body').on('click', '.change-status', function() {
                    let isChecked = $(this).is(':checked');
                    let id = $(this).data('id');

                    $.ajax({
                        url: "{{ route('reviews.change-status') }}",
                        method: 'PUT',
                        data: {
                            status: isChecked,
                            id: id
                        },
                        success: function(data) {
                            toastr.success(data.message)
                        },
                        error: function(xhr, status, error) {
                            console.log(error);
                        }
                    })

                })
            })
        </script>
    @endpush
@endsection
