@extends('layouts.main')

@section('main.content')
    <section>
        <div class="container">
            Redirect for payment...
        </div>
    </section>
@endsection

<script>
    window.location.href = "{{ $entity->url }}" // можно для переброса на старницу банка использовать и тег мета в заголовке
</script>
