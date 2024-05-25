@extends('layouts.app')
@section('content')
<div class="container">
    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header  border-0 d-flex justify-content-between">
                    <h4 class="card-title">Passwords List</h4>
                    <div class="btn-list">
                        <a href="javascript:void(0);" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#addpassmodal">Add Password</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-vcenter text-nowrap table-bordered border-bottom" id="passtable">
                            <thead>
                                <tr>
                                    <th class="border-bottom-0">Name</th>
                                    <th class="border-bottom-0">Email</th>
                                    <th class="border-bottom-0">Password</th>
                                    <th class="border-bottom-0">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($passwords as $row)
                                <tr>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->email }}</td>
                                    <td>{{ $row->password }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-sm editpass" data-id="{{ $row->id }}" data-name="{{ $row->name }}" data-email="{{ $row->email }}" data-password="{{ $row->password }}" data-bs-toggle="modal" data-bs-target="#editpassmodal">
                                            Edit
                                        </a>
                                        <a href="#" onclick="event.preventDefault(); document.getElementById('deleteForm_{{ $row->id }}').submit();" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-original-title="Delete">
                                            Delete
                                        </a>
                                        <form id="deleteForm_{{ $row->id }}" method="POST" action="{{ route('vault.destroy', $row->id ) }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>


                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Add Pass Modal -->
<div class="modal fade" id="addpassmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Password</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form id="addpassform" action="{{ route('vault.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input required name="name" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input name="email" type="text" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input name="password" type="text" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="closepassmodal" type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Pass Modal -->
<div class="modal fade" id="editpassmodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Password</h5>
                <button class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form id="editpassform" method="POST" action="{{ route('vault.update') }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Name</label>
                        <input required name="name" type="text" class="updatepassname form-control" value="">
                        <input hidden name="id" class="updatepassid">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input name="email" type="text" class="updatepassemail form-control" value="">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input name="password" type="text" class="updatepasspassword form-control" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="closepasseditmodal" type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary updatepass" type="submit" id="updatepass">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<!-- INTERNAL Data tables -->
<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatable/responsive.bootstrap5.min.js') }}"></script>

<script>
    $(document).ready(function() {

        $(document).on("click", "#closepasseditmodal", function() {
            $("#editpassform")[0].reset();
        });

        jQuery(document).on("click", ".editpass", function() {
            // Retrieve data attributes
            var updatepassid = $(this).data("id");
            var updatename = $(this).data("name");
            var updateemail = $(this).data("email");
            var updatepassword = $(this).data("password");
            var newAction = "{{ route('vault.update', ['id' => ':id']) }}".replace(':id', updatepassid);

            $("#editpassform .updatepassid").val(updatepassid);
            $("#editpassform .updatepassname").val(updatename);
            $("#editpassform .updatepassemail").val(updateemail);
            $("#editpassform .updatepasspassword").val(updatepassword);
            form.setAttribute('action', newAction);

        });

        $('#addpassform').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '{{ route("vault.store") }}',
                data: $('#addpassform').serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.status == 201) {
                        window.location.reload();
                    }
                },
                error: function(error) {}
            });
        });

    });
    $(function(e) {
        'use strict';
        // Data Table
        let table = $('#passtable').DataTable({
            "order": [
                [0, "desc"]
            ],
            order: [],
            paging: false,
            searching: false,
            info: false,
            scrollX:false,
            columnDefs: [{
                orderable: false,
                targets: [1]
            }],
        });

    });
</script>
@endpush
