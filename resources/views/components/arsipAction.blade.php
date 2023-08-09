<div class="d-flex justify-content-center">
    @if (Auth::user()->id == $arsip->user_id || Auth::user()->role == 'admin')
        <a href="{{ route('arsip.edit', $arsip->id) }}" class="btn btn-warning mr-2"><i class="fas fa-edit"></i></a>
    @endif
    <a href="{{ route('arsip.show', $arsip->id) }}" class="btn btn-primary mr-2"><i class="fas fa-eye"></i></a>
    @if (Auth::user()->role == 'admin')
        <form action="{{ route('arsip.delete', $arsip->id) }}" class="d-inline" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger"><i class="fas fa-trash"></i></button>
        </form>
    @endif
</div>
