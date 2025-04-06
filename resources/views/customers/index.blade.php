@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h3>Customers</h3>
        <button class="btn btn-success" onclick="showCustomerForm()">Add Customer</button>
    </div>
    <table class="table table-bordered" id="customer-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal" tabindex="-1" role="dialog" id="customerModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Customer Form</h5>
        <button type="button" class="close" onclick="$('#customerModal').modal('hide')">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="customer-form">
            <input type="hidden" name="id">
            <input type="hidden" name="type" value="customer">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label>Address</label>
                <textarea name="address" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
function loadCustomers() {
    $.get('/api/data', function(data) {
        const tbody = $('#customer-table tbody');
        tbody.empty();
        data.customers.forEach(c => {
            tbody.append(`<tr>
                <td>${c.id}</td>
                <td>${c.name}</td>
                <td>${c.phone ?? ''}</td>
                <td>${c.email ?? ''}</td>
                <td>${c.address ?? ''}</td>
                <td>
                    <button class="btn btn-sm btn-info" onclick='editCustomer(${JSON.stringify(c)})'>Edit</button>
                </td>
            </tr>`);
        });
    });
}

function showCustomerForm() {
    $('#customer-form')[0].reset();
    $('#customer-form input[name=id]').val('');
    $('#customerModal').modal('show');
}

function editCustomer(c) {
    $('#customer-form input[name=id]').val(c.id);
    $('#customer-form input[name=name]').val(c.name);
    $('#customer-form input[name=phone]').val(c.phone);
    $('#customer-form input[name=email]').val(c.email);
    $('#customer-form textarea[name=address]').val(c.address);
    $('#customerModal').modal('show');
}

$(document).ready(function () {
    loadCustomers();

    $('#customer-form').off('submit').on('submit', function(e) {
        e.preventDefault();
        $.post('/api/save', $(this).serialize(), function() {
            $('#customerModal').modal('hide');
            loadCustomers();
        });
    });
});
</script>
@endsection