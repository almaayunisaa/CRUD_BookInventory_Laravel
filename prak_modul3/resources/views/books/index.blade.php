@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Book Management (AJAX)</h1>
    <button class="btn btn-success mb-2" id="createNewBook">Add Book</button>
    <table class="table table-bordered" id="bookTable">
        <thead>
            <tr>
                <th>No</th>
                <th>Author</th>
                <th>Email</th>
                <th>Title</th>
                <th>Price</th>
                <th width="150px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal fade" id="ajaxBookModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="bookForm" name="bookForm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modelHeading"></h5>
        </div>
        <div class="modal-body">
            <input type="hidden" name="book_id" id="book_id">
            <div class="form-group">
                <label>Author</label>
                <select class="form-control" id="author_id" name="author_id">
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" id="title" name="title" class="form-control" placeholder="Enter Title">
            </div>
            <div class="form-group">
                <label>Year</label>
                <input type="number" id="year" name="year" class="form-control" placeholder="Enter Year">
            </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" id="saveBtn">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@section('page_script')
<script type="text/javascript">
$(function () {
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });

    var table = $('#bookTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('books.getBooks') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'author.name', name: 'author.name'},
            {data: 'author_email', name: 'author.email'},
            {data: 'title', name: 'title'},
            {data: 'year', name: 'year'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#createNewBook').click(function () {
        $('#saveBtn').val("create-book");
        $('#book_id').val('');
        $('#bookForm').trigger("reset");
        $('#modelHeading').html("Create New Book");
        $('#ajaxBookModal').modal('show');
    });

    $('#bookForm').submit(function (e) {
        e.preventDefault();
        $.ajax({
            data: $('#bookForm').serialize(),
            url: "{{ route('books.store') }}",
            type: "POST",
            success: function (data) {
                $('#bookForm').trigger("reset");
                $('#ajaxBookModal').modal('hide');
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('body').on('click', '.editBook', function () {
      var id = $(this).data('id');
      $.get("{{ url('books') }}" +'/' + id +'/edit', function (data) {
          $('#modelHeading').html("Edit Book");
          $('#saveBtn').val("edit-user");
          $('#ajaxBookModal').modal('show');
          $('#book_id').val(data.id);
          $('#title').val(data.title);
          $('#year').val(data.year);
          $('#author_id').val(data.author_id);
      })
    });

    $('body').on('click', '.deleteBook', function () {
        var id = $(this).data("id");
        confirm("Are You sure want to delete !");
        $.ajax({
            type: "DELETE",
            url: "{{ url('books') }}"+'/'+id,
            success: function (data) {
                table.draw();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

});
</script>
@endsection
