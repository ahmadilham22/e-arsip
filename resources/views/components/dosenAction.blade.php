<div class="d-flex justify-content-center">
    <div class="mr-3">
        <a href="{{ route('dosen.edit', $model->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
    </div>
    <form action="{{ route('dosen.delete', $model->id) }}" class="d-inline" method="POST">
        @csrf
        @method('DELETE')
        <button href="" class="btn btn-danger"><i class="fas fa-trash"></i></button>
    </form>
</div>
