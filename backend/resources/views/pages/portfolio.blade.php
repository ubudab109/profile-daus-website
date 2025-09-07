@extends('master')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Portfolio</h1>


    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 table-responsive">
                        <a class="btn btn-primary float-end" href="{{route('create.portfolio')}}">Add</a>
                        <table class="table" id="portfolio">
                            <thead>
                                <th>Title</th>
                                <th>Category</th>
                                <th>URL</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Action</th>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var table = $("#portfolio").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('portfolio') }}",
        columns: [
            { data: 'title', name: 'title' },
            { data: 'category', name: 'category' },
            { data: 'url', name: 'url' },
            { data: 'start_date', name: 'start_date' },
            { data: 'end_date', name: 'end_date' },
            { data: 'action', name: 'action' },
        ]
    });

    function destroy(id) {
        let url = "{{ route('delete.portfolio', ':id') }}";
        url = url.replace(':id', id);
        if (confirm("Want to delete this?") === true) {
            $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: () => {
                    alert('Deleted Successfully');
                    table.draw();
                },
                error: () => {
                    alert('Error when deleting. Try again');
                }
            })
        } else {
            return false;
        }
    }
    
    function edit(id) {
        let url = "{{route('detail.skills', ':id')}}"
        url = url.replace(":id", id);
    }
</script>
@endsection