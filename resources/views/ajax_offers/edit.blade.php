@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none">
            Offer update successfully
        </div>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    {{__('messages.Add Your Offer')}}
                </div>
                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}

                    </div>
                @endif
                <form method="POST" id="offerFormUpdate" action="" enctype="multipart/form-data">
                    @csrf
                    {{--<input name="_token" value="{{csrf_token()}}">--}}

                    <input type="text" style="display: none;" class="form-control"
                           value="{{$offer -> id}}" name="offer_id">

                    <div class="form group">
                        <label for="exampleInputEmail1">{{__('messages.Add photo')}}</label>
                        <input type="file" class="form-control" name="photo" value="{{$offer -> photo}}" placeholder="{{__('messages.Photo')}}">
                        @error('photo')
                        <small class="form-text text-danger">{{$message}}</small>'
                        @enderror
                    </div>

                    <div class="form group">
                        <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                        <input type="text" class="form-control" name="name_ar" value="{{$offer -> name_ar}}" placeholder="{{__('messages.Enter Offer Name')}}">
                        @error('name_ar')
                        <small class="form-text text-danger">{{$message}}</small>'
                        @enderror
                    </div>

                    <div class="form group">
                        <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                        <input type="text" class="form-control" name="name_en" value="{{$offer -> name_en}}" placeholder="{{__('messages.Enter Offer Name')}}">
                        @error('name_en')
                        <small class="form-text text-danger">{{$message}}</small>'
                        @enderror
                    </div>
                    <div class="form group">
                        <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Price')}}</label>
                        <input type="text" class="form-control" name="price" value="{{$offer -> price}}" placeholder="{{__('messages.Enter Offer Price')}}">
                        @error('price')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form group">
                        <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Details ar')}}</label>
                        <input type="text" class="form-control" name="details_ar" value="{{$offer -> details_ar}}" placeholder="{{__('messages.Enter Offer Details')}}">
                        @error('details_ar')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>

                    <div class="form group">
                        <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Details en')}}</label>
                        <input type="text" class="form-control" name="details_en" value="{{$offer -> details_en}}" placeholder="{{__('messages.Enter Offer Details')}}">
                        @error('details_en')
                        <small class="form-text text-danger">{{$message}}</small>
                        @enderror
                    </div>
                    <div><br /></div>

                    <button id="update_offer" class="btn btn-primary">{{__('messages.Save')}}</button>
                </form>

            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script>
        $(document).on('click', '#update_offer', function(e){
            e.preventDefault();
            var formData = new FormData($('#offerFormUpdate')[0]);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data', {{--pour les fichiers--}}
                url: "{{route('ajax.offers.update')}}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data){
                    if(data.status == true){
                        $('#success_msg').show();
                    }

                }, error: function (reject){
                }
            });

        });

    </script>
@stop
