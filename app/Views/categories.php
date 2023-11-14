<?= $this->extend('template/admin_template'); ?>

<?= $this->section('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Category Management</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalID">
                    Add Category
                </button>
            </div>
        </div>

        <table id="dataTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Severity</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>

        <div class="modal fade" id="modalID" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Category Details</h5>
                        <buton type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </buton>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" novalidate>
                            <div class="card-body">
                                <input type="hidden" id="id" name="id">
                                <div class="form-group">
                                    <label for="cat_severity">Severity Level</label>
                                    <input type="text" class="form-control" id="cat_severity" name="cat_severity" placeholder="Enter severity level" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter a severity level.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cat_status">Status Level</label>
                                    <input type="text" class="form-control" id="cat_status" name="cat_status" placeholder="Enter status level" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter status level.
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
    $(function() {

        $("form").submit(function(event) {
            event.preventDefault();

            let formData = $(this).serializeArray().reduce(function(obj, item) {
                obj[item.name] = item.value;
                return obj;
            }, {});

            let jsonData = JSON.stringify(formData);

            if (this.checkValidity()) {
                if (!formData.id) {
                    $.ajax({
                        url: "<?= base_url('categories'); ?>",
                        type: "POST",
                        data: jsonData,
                        success: function(data) {
                            $(document).Toasts('create', {
                                class: 'bg-success',
                                title: 'Success',
                                subtitle: 'Category',
                                body: 'Record successfully added.',
                                autohide: true,
                                delay: 3000
                            });
                            $("#modalID").modal("hide");
                            clearForm();
                            table.ajax.reload();
                        },
                        error: function(result) {
                            $(document).Toasts('create', {
                                class: 'bg-danger',
                                title: 'Error',
                                subtitle: 'Category',
                                body: 'Record not added.',
                                autohide: true,
                                delay: 3000
                            });
                        }
                    });
                } else {
                    $.ajax({
                        url: "<?= base_url('categories'); ?>/" + formData.id,
                        type: "PUT",
                        data: jsonData,
                        success: function(data) {
                            $(document).Toasts('create', {
                                class: 'bg-success',
                                title: 'Success',
                                subtitle: 'Category',
                                body: 'Record successfully udpated.',
                                autohide: true,
                                delay: 3000
                            });
                            $("#modalID").modal("hide");
                            clearForm();
                            table.ajax.reload();
                        },
                        error: function(result) {
                            $(document).Toasts('create', {
                                class: 'bg-danger',
                                title: 'Error',
                                subtitle: 'Category',
                                body: 'Record not updated.',
                                autohide: true,
                                delay: 3000
                            });
                        }
                    });
                }
            }
        });
    });

    let table = $("#dataTable").DataTable({
        responsive: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= base_url('categories/list'); ?>",
            type: "POST"
        },
        columns: [{
                data: "id",
            },
            {
                data: 'cat_severity',
            },
            {
                data: 'cat_status',
            },
            {
                data: '',
                defaultContent: `<td class="text-right py-0 align-middle"><div class="btn-group btn-group-sm">
            <a class="btn btn-info" id="editRow"><i class="fas fa-eye"></i></a>
            <a class="btn btn-danger" id="deleteRow"><i class="fas fa-trash"></i></a>
            </td>`
            }
        ],
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: true,
        lengthMenu: [5, 10, 20, 50]

    });

    $(document).on("click", "#editRow", function() {
        let row = $(this).parents("tr")[0];
        let id = table.row(row).data().id;

        $.ajax({
            url: "<?= base_url('categories'); ?>/" + id,
            type: "GET",
            success: function(data) {
                $("#modalID").modal("show");
                $("#id").val(data.id);
                $("#cat_severity").val(data.cat_severity);
                $("#cat_status").val(data.cat_status);
            },
            error: function(result) {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Error',
                    subtitle: 'Category',
                    body: 'Record not found.',
                    autohide: true,
                    delay: 3000
                });
            }
        });
    });

    $(document).on("click", "#deleteRow", function() {
        let row = $(this).parents("tr")[0];
        let id = table.row(row).data().id;

        if (confirm("Are you sure you want to delete this record?")) {
            $.ajax({
                url: "<?= base_url('categories'); ?>/" + id,
                type: "DELETE",
                success: function(data) {
                    $(document).Toasts('create', {
                        class: 'bg-success',
                        title: 'Success',
                        subtitle: 'Category',
                        body: 'Record was deleted.',
                        autohide: true,
                        delay: 3000
                    });
                    table.ajax.reload();
                },
                error: function(result) {
                    $(document).Toasts('create', {
                        class: 'bg-danger',
                        title: 'Error',
                        subtitle: 'Category',
                        body: 'Record not found.',
                        autohide: true,
                        delay: 3000
                    });
                }
            });
        }
    });

    function clearForm() {
        $("#id").val("");
        $("#cat_severity").val("");
        $("#cat_status").val("");
    }

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