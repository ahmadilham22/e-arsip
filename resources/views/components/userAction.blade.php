<div class="d-flex justify-content-center">
    <div class="mr-1">
        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning mr-3"><i class="fas fa-edit mr-1"></i>Edit</a>
    </div>
    <form action="{{ route('user.delete', $user->id) }}" class="d-inline" method="POST">
        @csrf
        @method('DELETE')
        <button href="" class="btn btn-danger"><i class="fas fa-trash mr-2"></i>Hapus</button>
    </form>
</div>
