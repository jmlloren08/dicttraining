<?= $this->extend('template/admin_template'); ?>

<?= $this->section('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">User Management</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalID">
                    Add User
                </button>
            </div>
        </div>
        <table id="dataTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Fullname</th>
                    <th>Username</th>
                    <th>Email Address</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>

        <div class="modal fade" id="modalID" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Office Details</h5>
                        <buton type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </buton>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" novalidate>
                            <div class="card-body">
                                <input type="hidden" id="id" name="id">
                                <div class="form-group">
                                    <label for="office_name">Office Name</label>
                                    <input type="text" class="form-control" id="office_name" name="office_name" placeholder="Enter your office" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter a office name.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="office_code">Office Code</label>
                                    <input type="text" class="form-control" id="office_code" name="office_code" placeholder="Enter office code" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter office code.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="office_description">Office Description</label>
                                    <input type="text" class="form-control" id="office_description" name="office_description" placeholder="Enter office code" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter description.
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('pagescripts'); ?>

<script>
    let table = $("#dataTable").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= base_url('users/list'); ?>",
            type: "POST"
        },
        columns: [{
                data: "fullname",
            },
            {
                data: 'username',
            },
            {
                data: 'email',
            },
            {
                data: 'role',
                render: function(data, type, row) {
                    if (data === 'Unidentified') {
                        return '<span class="badge badge-warning">Unidentified</span>';
                    } else if (data === 'User') {
                        return '<span class="badge badge-primary">User</span>';
                    } else {
                        return '<span class="badge badge-success">Admin</span>';
                    }
                }
            },
            {
                data: 'status',
                render: function(data, type, row) {
                    return data === '0' ? '<span class="badge badge-danger">Unverified</span>' : '<span class="badge badge-success">Verified</span>';
                }
            },
            {
                data: '',
                defaultContent: `<td>
            <button class="btn btn-warning btn-sm" id="editRow">Edit</button>
            <button class="btn btn-danger btn-sm" id="deleteRow">Delete</button>
            </td>`
            }
        ],
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: true,
        lengthMenu: [10, 20, 30, 50]

    });

    $(document).ready(function() {
        'use strict';

        let form = $(".needs-validation");

        form.each(function() {
            $(this).on('submit', function(event) {
                if (this.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                $(this).addClass('was-validated');
            });
        });
    });
</script>

<?= $this->endSection(); ?>