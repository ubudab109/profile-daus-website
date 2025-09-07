@extends('master')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Skills</h1>
    <div class="row">
        <!-- Modal Create -->
        <div class="modal fade" id="create_skills" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create Skill</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="submit_create_skill">
                            <table class="table" id="skill_add">
                                <thead>
                                    <tr>
                                        <th>Skill</th>
                                        <th>Percentage</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td id="col0">
                                            <input type="text" name="skills[]" class="form-control skills">
                                        </td>
                                        <td id="col1">
                                            <input type="number" min="0" max="100" name="percentage[]" class="form-control percentage">
                                        </td>
                                        <td id="col2">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
                            <button type="button" class="btn btn-primary mt-2" onclick="addRow()">Add Skills</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="edit_skills" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Skill</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="submit_edit_skill">
                            <table class="table" id="skill_update">
                                <thead>
                                    <tr>
                                        <th>Skill</th>
                                        <th>Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="hidden" name="id" id="id_skill">
                                            <input type="text" id="update_skill" name="skills" class="form-control">
                                        </td>
                                        <td>
                                            <input type="number" id="update_percentage" min="0" max="100" name="percentage" class="form-control">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary mt-2">Submit</button>
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
                            data-bs-target="#create_skills">Add</button>
                        <table class="table" id="skills">
                            <thead>
                                <th>Skill</th>
                                <th>Percentage</th>
                                <th>Actions</th>
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
    var table = $("#skills").DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('skills') }}",
        columns: [
            { data: 'name', name: 'name' },
            { data: 'percentage', name: 'percentage' },
            { data: 'action', name: 'action' },
        ]
    });
    $("#submit_create_skill").submit(e => {
        e.preventDefault();
        let data = [];
        $("#skill_add tr :input[type='text']").each((i, v) => {
            var value = $(v).val();
            let skill = {
                'skill': value,
                'percentage': 0,
            };
            data.push(skill);
        });
        $("#skill_add tr :input[type='number']").each((i, v) => {
            var value = $(v).val();
            data[i]['percentage'] = value;
        });
        let formBody = {
            'data': data,
        };
        $.ajax({
            url: "{{route('create.skills')}}",
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formBody,
            success: res => {
                alert('Success');
                $('#create_skills').modal('hide')
                table.draw();
            },
            error: err => {
                alert('Error');
            }
        })
    });

    $("#submit_edit_skill").submit(e => {
        e.preventDefault();
        const id = $("#id_skill").val();
        const skill = $("#update_skill").val();
        const percentage = $("#update_percentage").val();
        let url = "{{route('update.skills', ':id')}}"
        url = url.replace(':id', id);
        const formBody = {
            skill: skill,
            percentage: percentage,
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
                $('#edit_skills').modal('hide')
                table.draw();
            },
            error: err => {
                alert('Error');
            }
        })
    });

    function deleteRow(row) {
        var i = row.parentNode.parentNode.rowIndex;
        document.getElementById('skill_add').deleteRow(i)
    }

    function addRow(e) {
        var table = document.getElementById('skill_add');
        var rowCount = table.rows.length;
        var cellCount = table.rows[0].cells.length;
        var row = table.insertRow(rowCount);
        for (var i = 0; i <= cellCount; i++) {
            var cell = 'cell' + i;
            cell = row.insertCell(i);
            if (i !== 2) {
                var copyCel = document.getElementById('col'+i).innerHTML;
                console.log(copyCel);
            } else {
                var copyCel = '<button type="button" class="btn btn-danger" onclick="deleteRow(this)">Delete</button>';
            }
            cell.innerHTML = copyCel;
        }
    }

    function destroy(id) {
        let url = "{{route('delete.skills', ':id')}}}"
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
        let url = "{{route('detail.skills', ':id')}}"
        url = url.replace(":id", id);
        $.ajax({
            url: url,
            type: 'GET',
            success: res => {
                const data = res.data;
                $("#id_skill").val(id);
                $("#update_skill").val(data.name);
                $("#update_percentage").val(data.percentage);
                $("#edit_skills").modal('show');
            },
            error: err => {
                alert("data not found");
            }
        })
    }
</script>
@endsection