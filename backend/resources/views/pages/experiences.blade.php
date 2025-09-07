@extends('master')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Experiences</h1>
    <div class="row">
        <!-- Modal Create -->
        <div class="modal fade" id="create_experiences" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Experiences</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="submit_create_exp">
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" required name="title" id="title"
                                    placeholder="ex: Fullstack Developer" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Company Name</label>
                                <input type="text" required name="company_name" id="company_name"
                                    placeholder="ex: Company Name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Location</label>
                                <input type="text" required name="location" id="location"
                                    placeholder="ex: Jakarta, Indonesia" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Start Date</label>
                                <input type="date" required name="start_date" id="start_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea class="form-control summernote" name="desc" id="summernote"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Stack</label>
                                <textarea class="form-control" id="stack" name="stack"
                                    placeholder="Separate with comma"></textarea>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="update_experiences" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Experiences</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="submit_update_exp">
                            <div class="form-group">
                                <input type="hidden" name="" id="id_update">
                                <label for="">Title</label>
                                <input type="text" required name="title" id="title_update"
                                    placeholder="ex: Fullstack Developer" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Company Name</label>
                                <input type="text" required name="company_name" id="company_name_update"
                                    placeholder="ex: Company Name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Location</label>
                                <input type="text" required name="location" id="location_update"
                                    placeholder="ex: Jakarta, Indonesia" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Start Date</label>
                                <input type="date" required name="start_date" id="start_date_update" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">End Date</label>
                                <input type="date" name="end_date" id="end_date_update" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea class="form-control summernote" name="desc" id="summernote_update"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Stack</label>
                                <textarea class="form-control" id="stack_update" name="stack"
                                    placeholder="Separate with comma"></textarea>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="col-12 table-responsive">
                        <button class="btn btn-primary float-end" data-bs-toggle="modal"
                            data-bs-target="#create_experiences">Add</button>
                        <table class="table" id="experiences">
                            <thead>
                                <th>Title</th>
                                <th>Company</th>
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
    tinymce.init({
        selector: '.summernote',
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    });
    var table = $("#experiences").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('experiences') }}",
        columns: [
            { data: 'title', name: 'title' },
            { data: 'company_name', name: 'company_name' },
            { data: 'start_date', name: 'start_date' },
            { data: 'end_date', name: 'end_date' },
            { data: 'action', name: 'action' },
        ]
    });
    $("#submit_create_exp").submit(e => {
        e.preventDefault();
        var title = $("#title").val();
        var companyName = $("#company_name").val();
        var location = $("#location").val();
        var startDate = $("#start_date").val();
        var endDate = $("#end_date").val();
        var desc = tinymce.get("summernote").getContent();
        var stack = $("#stack").val();
        let formBody = {
            title: title,
            company_name: companyName,
            location: location,
            start_date: startDate,
            end_date: endDate,
            desc: desc,
            stack: stack.split(',')
        };
        $.ajax({
            url: "{{route('create.experiences')}}",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formBody,
            success: res => {
                alert('Success');
                $('#create_experiences').modal('hide')
                table.draw();
            },
            error: err => {
                alert('Error');
            }
        })
    });
    $("#submit_update_exp").submit(e => {
        e.preventDefault();
        const id = $("#id_update").val();
        const title = $("#title_update").val();
        const companyName = $("#company_name_update").val();
        const location = $("#location_update").val();
        const startDate = $("#start_date_update").val();
        const endDate = $("#end_date_update").val();
        const desc = tinymce.get("summernote_update").getContent();
        const stack = $("#stack_update").val();
        let url = "{{route('update.experiences', ':id')}}"
        url = url.replace(':id', id);
        const formBody = {
            title: title,
            company_name: companyName,
            location: location,
            start_date: startDate,
            end_date: endDate,
            desc: desc,
            stack: stack.split(',')
        };
        $.ajax({
            url: url,
            type: 'PUT',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formBody,
            success: res => {
                alert('Success');
                $('#update_experiences').modal('hide')
                table.draw();
            },
            error: err => {
                alert('Error');
            }
        })
    })
    function destroy(id) {
        let url = "{{route('delete.experiences', ':id')}}}"
        url = url.replace(':id', id);
        if (confirm("Want to delete this?") === true) {
            $.ajax({
                url: url,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: res => {
                    alert('Deleted Successfully');
                    table.draw();
                },
                error: err => {
                    alert('Error or data not found');
                }
            })
        } else {
            return false;
        }
    }
    function edit(id) {
        let url = "{{route('detail.experiences', ':id')}}"
        url = url.replace(":id", id);
        $.ajax({
            url: url,
            type: 'GET',
            success: res => {
                const data = res.data;
                const stack = JSON.parse(data.stack);
                const joinStack = stack.join(',');
                $("#id_update").val(id);
                $("#title_update").val(data.title);
                $("#company_name_update").val(data.company_name);
                $("#location_update").val(data.location);
                $("#start_date_update").val(data.start_date);
                $("#end_date_update").val(data.end_date);
                if (data.dest) tinymce.get("summernote_update").setContent(data.desc);
                $("#stack_update").val(joinStack);
                $("#update_experiences").modal('show');
            },
            error: err => {
                alert("data not found");
            }
        })
    }
</script>
@endsection