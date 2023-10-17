<div class="d-flex justify-content-center">
    <div class="mr-3">
        <a href="{{ route('dosen.edit', $model->id) }}" class="btn btn-warning"><i class="fas fa-edit mr-1"></i>Edit</a>
    </div>
    <form action="{{ route('dosen.delete', $model->id) }}" class="d-inline" method="POST">
        @csrf
        @method('DELETE')
        <button href="" class="btn btn-danger"><i class="fas fa-trash mr-2"></i>Hapus</button>
    </form>
</div>
