<tr>
    <td class="dtr-control"></td>
    <td class="dtr-control">{{ $employee->name }}</td>
    <td class="dtr-control">{{ $employee->position->name }}</td>
    <td class="dtr-control">{{ $employee->employment_at }}</td>
    <td class="dtr-control">{{ $employee->phone }}</td>
    <td class="dtr-control">{{ $employee->email }}</td>
    <td class="dtr-control">{{ $employee->salary }}</td>
    <td class="dtr-control">
        <div class="row d-flex justify-content-center">
            <div class="col-md-3">
                <a class="btn" href="{{ route('employees.edit', $employee) }}">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            </div>
            <div class="col-md-3">
                <button type="button"
                        class="btn employee_delete"
                        data-toggle="modal"
                        data-target="#employee_delete_modal"
                        data-href="{{ route('employees.destroy', $employee) }}"
                        data-object="{{ $employee }}"
                >
                    <i class="far fa-trash-alt"></i>
                </button>
            </div>
        </div>
    </td>
</tr>
