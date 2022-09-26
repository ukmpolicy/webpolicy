@extends('guest.layout.main')
@section('d_style') 
<style>
    
  #choiceImage {
    margin: auto;
    height: 200px;
    width: 200px;
    padding: .2rem;
    position: relative;
    align-items: center;
    justify-content: center;
    border: 2px dashed #ddd;
    border-radius: 4px;
  }
  #choiceImage img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 4px;
  }
  
  #choiceImage .label {
    left: .2rem;
    top: .2rem;
    right: .2rem;
    bottom: .2rem;
    cursor: pointer;
    display: flex;
    transition: .3s;
    border-radius: 4px;
    position: absolute;
    align-items: center;
    justify-content: center;
  }
  
  #choiceImage:hover .label {
    background-color: rgba(0,0,0,.5);
    color: #fff;
  }
  #kirim {
      width: 100%;
      padding: 8px 16px;
      margin-top: 1rem;
  }
</style>
@endsection
@section('content')
    <div id="recruitment">
        <div class="container py-5">
            
            <div class="head">
                <h2>DATA BERHASIL TERKIRIM</h2>
                <div class="devider"></div>
            </div>
        </div>
    </div>
@endsection
@section('d_script')
<script src="{{ asset('plugins/axios/axios.min.js') }}"></script>
<script src="{{ asset('plugins/Venobox/venobox.min.js') }}"></script>
<script src="{{ asset('js/page.js') }}"></script>
<script>
    document.querySelector('#navbar').classList.add('scroll')
</script>
@endsection
