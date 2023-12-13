<?php

if (session('user')['role'] === 'Admin') {
    $requireddisabled   = "disabled";
    //$valstat            = null;
} else {
    $requireddisabled   = "required";
    //$valstat            = "Open";
}

?>

<?= $this->extend('template/admin_template'); ?>

<?= $this->section('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Support Ticket Management</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row mb-2">

            <?php if (session('user')['role'] === 'User') : ?>
                <div class="row m-2">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalID">
                        Add Ticket
                    </button>
                </div>
            <?php endif; ?>

        </div>
        <table id="dataTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Office/Section/Description</th>
                    <th>Severity</th>
                    <th>Description/Remarks</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>

        <div class="modal fade" id="modalID" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ticket Details</h5>
                        <buton type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </buton>
                    </div>
                    <div class="modal-body">
                        <form class="needs-validation" novalidate>
                            <div class="card-body">
                                
                                <input type="hidden" id="id" name="id">
                                <input type="hidden" id="user_id" name="user_id" value="<?= session('user')['id']; ?>">

                                <?php if (session('user')['role'] === 'Admin') : ?>
                                    <div class="form-group">
                                        <label for="ticket_status_id">Update Status</label>
                                        <select class="form-control custom-select" name="ticket_status_id" id="ticket_status_id" required>
                                            <option value="">Select Status</option>
                                            <?php foreach ($categories as $category) : ?>
                                                <option value="<?= $category['id']; ?>"><?= $category['cat_status']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                        <div class="invalid-feedback">
                                            Please update status.
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <label for="ticket_firstname">First Name</label>
                                    <input type="text" class="form-control" id="ticket_firstname" name="ticket_firstname" placeholder="Enter your first name" <?= $requireddisabled; ?>>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter a valid name.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ticket_lastname">Last Name</label>
                                    <input type="text" class="form-control" id="ticket_lastname" name="ticket_lastname" placeholder="Enter your last name" <?= $requireddisabled; ?>>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter a valid name.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ticket_email">Email Address</label>
                                    <input type="email" class="form-control" id="ticket_email" name="ticket_email" placeholder="Enter your email address" <?= $requireddisabled; ?>>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter a valid email.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="office_id">Office</label>
                                    <select class="form-control custom-select" name="office_id" id="office_id" <?= $requireddisabled; ?>>
                                        <option value="">Select Office</option>
                                        <?php foreach ($offices as $office) : ?>
                                            <option value="<?= $office['id']; ?>"><?= $office['office_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please enter a valid office.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="ticket_severity_id">Level of Severity</label>
                                    <select class="form-control custom-select" name="ticket_severity_id" id="ticket_severity_id" <?= $requireddisabled; ?>>
                                        <option value="">Select Severity</option>
                                        <?php foreach ($categories as $category) : ?>
                                            <option value="<?= $category['id']; ?>"><?= $category['cat_severity']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Please select a severe.
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="ticket_description">Description/Remarks</label>
                                    <textarea type="textarea" rows="3" class="form-control" id="ticket_description" name="ticket_description" placeholder="Enter description here..." required></textarea>
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
                        url: "<?= base_url('tickets'); ?>",
                        type: "POST",
                        data: jsonData,
                        success: function(data) {
                            $(document).Toasts('create', {
                                class: 'bg-success',
                                title: 'Success',
                                subtitle: 'Ticket',
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
                                subtitle: 'Ticket',
                                body: 'Record not added.',
                                autohide: true,
                                delay: 3000
                            });
                        }
                    });
                } else {
                    $.ajax({
                        url: "<?= base_url('tickets'); ?>/" + formData.id,
                        type: "PUT",
                        data: jsonData,
                        success: function(data) {
                            $(document).Toasts('create', {
                                class: 'bg-success',
                                title: 'Success',
                                subtitle: 'Ticket',
                                body: 'Record successfully updated.',
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
                                subtitle: 'Ticket',
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
            url: "<?= base_url('tickets/list'); ?>",
            type: "POST"
        },

        columns: [{
                data: "id",
            },
            {
                data: 'ticket_firstname',
            },
            {
                data: 'ticket_lastname',
            },
            {
                data: 'ticket_email',
            },
            {
                data: 'office',
            },
            {
                data: 'catseverity',
            },
            {
                data: 'ticket_description',
            },
            {
                data: 'catstatus',
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
        lengthMenu: [10, 20, 30, 50],

        //color coding severity...
        rowCallback: function(row, data) {
            var severity = data.catseverity;
            var badgeColor;
            switch (severity) {
                case 'Low':
                    badgeColor = 'badge bg-primary';
                    break;
                case 'Medium':
                    badgeColor = 'badge bg-warning';
                    break;
                case 'High':
                    badgeColor = 'badge bg-orange';
                    break;
                case 'Critical':
                    badgeColor = 'badge bg-danger';
                    break;
                default:
                    badgeColor = 'badge';
            }

            $('td:eq(5)', row).html(`<span class="${badgeColor}">${severity}</span>`);

            var status = data.catstatus;
            var badgeColor2;

            switch (status) {
                case 'Open':
                    badgeColor2 = 'badge badge-secondary';
                    break;
                case 'Pending':
                    badgeColor2 = 'badge badge-info';
                    break;
                case 'Processing':
                    badgeColor2 = 'badge badge-warning';
                    break;
                case 'Resolved':
                    badgeColor2 = 'badge badge-success';
                    break;
                default:
                    badgeColor2 = 'badge';
            }

            $('td:eq(7)', row).html(`<span class="${badgeColor2}">${status}</span>`);

            if (status == "Resolved") {
                $(row).css('background-color', '#01ff70');
            }
        }

    });

    //end


    // for edit rows

    $(document).on("click", "#editRow", function() {
        let row = $(this).parents("tr")[0];
        let id = table.row(row).data().id;

        $.ajax({
            url: "<?= base_url('tickets'); ?>/" + id,
            type: "GET",
            success: function(data) {
                $("#modalID").modal("show");
                $("#id").val(data.id);
                $("#office_id").val(data.office_id);
                $("#ticket_firstname").val(data.ticket_firstname);
                $("#ticket_lastname").val(data.ticket_lastname);
                $("#ticket_email").val(data.ticket_email);
                $("#ticket_severity_id").val(data.ticket_severity_id);
                $("#ticket_description").val(data.ticket_description);
                $("#ticket_status_id").val(data.ticket_status_id);
            },
            error: function(result) {
                $(document).Toasts('create', {
                    class: 'bg-danger',
                    title: 'Error',
                    subtitle: 'Ticket',
                    body: 'Record not found.',
                    autohide: true,
                    delay: 3000
                });
            }
        });
    });

    //end

    ///for delete rows

    $(document).on("click", "#deleteRow", function() {
        let row = $(this).parents("tr")[0];
        let id = table.row(row).data().id;

        if (confirm("Are you sure you want to delete this record?")) {
            $.ajax({
                url: "<?= base_url('tickets'); ?>/" + id,
                type: "DELETE",
                success: function(data) {
                    $(document).Toasts('create', {
                        class: 'bg-success',
                        title: 'Success',
                        subtitle: 'Ticket',
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
                        subtitle: 'Post',
                        body: 'Record not found.',
                        autohide: true,
                        delay: 3000
                    });
                }
            });
        }
    });

    //end

    // clear all fields

    function clearForm() {
        $("#id").val("");
        $("#office_id").val("");
        $("#ticket_firstname").val("");
        $("#ticket_lastname").val("");
        $("#ticket_email").val("");
        $("#ticket_severity_id").val("");
        $("#ticket_description").val("");
        $("#ticket_status_id").val("");
    }

    //end

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