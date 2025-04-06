@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h3>Invoices</h3>
        <button class="btn btn-success" onclick="showInvoiceForm()">Add Invoice</button>
    </div>
    <table class="table table-bordered" id="invoice-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer</th>
                <th>Date</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal" tabindex="-1" role="dialog" id="invoiceModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Invoice Form</h5>
        <button type="button" class="close" onclick="$('#invoiceModal').modal('hide')">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="invoice-form">
            <input type="hidden" name="id">
            <input type="hidden" name="type" value="invoice">
            <div class="form-group">
                <label>Customer</label>
                <select name="customer_id" class="form-control" required></select>
            </div>
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="date" class="form-control">
            </div>
            <div class="form-group">
                <label>Amount</label>
                <input type="number" name="amount" class="form-control">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="Unpaid">Unpaid</option>
                    <option value="Paid">Paid</option>
                    <option value="Cancelled">Cancelled</option>
                </select>
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
function loadInvoices() {
    $.get('/api/data', function(data) {
        const tbody = $('#invoice-table tbody');
        const select = $('#invoice-form select[name=customer_id]');
        tbody.empty();
        select.empty();
        data.customers.forEach(c => {
            select.append(`<option value="${c.id}">${c.name}</option>`);
        });
        data.invoices.forEach(i => {
            tbody.append(`<tr>
                <td>${i.id}</td>
                <td>${i.customer_name}</td>
                <td>${i.date}</td>
                <td>${i.amount}</td>
                <td>${i.status}</td>
                <td>
                    <button class="btn btn-sm btn-info" onclick='editInvoice(${JSON.stringify(i)})'>Edit</button>
                </td>
            </tr>`);
        });
    });
}

function showInvoiceForm() {
    $('#invoice-form')[0].reset();
    $('#invoice-form input[name=id]').val('');
    $('#invoiceModal').modal('show');
}

function editInvoice(i) {
    $('#invoice-form input[name=id]').val(i.id);
    $('#invoice-form select[name=customer_id]').val(i.customer_id);
    $('#invoice-form input[name=date]').val(i.date);
    $('#invoice-form input[name=amount]').val(i.amount);
    $('#invoice-form select[name=status]').val(i.status);
    $('#invoiceModal').modal('show');
}

$(document).ready(function () {
    loadInvoices();

    $('#invoice-form').off('submit').on('submit', function(e) {
        e.preventDefault();
        $.post('/api/save', $(this).serialize(), function() {
            $('#invoiceModal').modal('hide');
            loadInvoices();
        });
    });
});
</script>
@endsection