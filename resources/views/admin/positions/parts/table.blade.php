<tr>
    <td class="dtr-control">{{ $position->name }}</td>
    <td class="dtr-control">{{ $position->updated_at }}</td>
    <td class="dtr-control">
        <div class="row d-flex justify-content-center">
            <div class="col-md-3">
                <a class="btn" href="{{ route('positions.edit', $position) }}">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            </div>
            <div class="col-md-3">
                <button type="button"
                        id="position_delete_button"
                        class="btn"
                        data-toggle="modal"
                        data-target="#position_delete_modal"
                        data-href="{{ route('positions.destroy', $position) }}"
                        data-name="{{ $position->name }}"
                >
                    <i class="far fa-trash-alt"></i>
                </button>
            </div>
        </div>
    </td>
</tr>
