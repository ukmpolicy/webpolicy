@extends('admin.layouts.index')

@section('content')

<div class="container-fluid py-2">

    <img src="" class="img-thumbnail" id="image" alt="">
    <input type="text" id="test" class="form-control w-25 mb-2">
    <button class="btn btn-primary" onclick="library.open('#test')">CHOICE</button>

</div>

@endsection

@section('script')

<script src="{{ asset('plugins/axios/axios.min.js') }}"></script>

@include('admin.components.library')

<script>
    let library = new Library();
    library.onChoiced = (r) => {
        console.log(r);
        library.close();
        document.querySelector('#image').src = `{{ asset('') }}${r.path}`;
    }
</script>

@endsection