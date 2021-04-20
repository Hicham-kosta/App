@extends('layouts.app')

@section('content')
    <div class="container">
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
            <form method="POST" action="{{route('ajax.offers.store')}}" enctype="multipart/form-data">
                @csrf
                {{--<input name="_token" value="{{csrf_token()}}">--}}

                <div class="form group">
                    <label for="exampleInputEmail1">{{__('messages.Add photo')}}</label>
                    <input type="file" class="form-control" name="photo" placeholder="{{__('messages.Photo')}}">
                    @error('photo')
                    <small class="form-text text-danger">{{$message}}</small>'
                    @enderror
                </div>

                <div class="form group">
                    <label for="exampleInputEmail1">{{__('messages.Offer Name ar')}}</label>
                    <input type="text" class="form-control" name="name_ar" placeholder="{{__('messages.Enter Offer Name')}}">
                    @error('name_ar')
                    <small class="form-text text-danger">{{$message}}</small>'
                    @enderror
                </div>

                <div class="form group">
                    <label for="exampleInputEmail1">{{__('messages.Offer Name en')}}</label>
                    <input type="text" class="form-control" name="name_en" placeholder="{{__('messages.Enter Offer Name')}}">
                    @error('name_en')
                    <small class="form-text text-danger">{{$message}}</small>'
                    @enderror
                </div>
                <div class="form group">
                    <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Price')}}</label>
                    <input type="text" class="form-control" name="price" placeholder="{{__('messages.Enter Offer Price')}}">
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="form group">
                    <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Details ar')}}</label>
                    <input type="text" class="form-control" name="details_ar" placeholder="{{__('messages.Enter Offer Details')}}">
                    @error('details_ar')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="form group">
                    <label for="exampleInputPassword1" class="form-label">{{__('messages.Offer Details en')}}</label>
                    <input type="text" class="form-control" name="details_en" placeholder="{{__('messages.Enter Offer Details')}}">
                    @error('details_en')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div><br /></div>

                <button id="save" class="btn btn-primary">{{__('messages.Save')}}</button>
            </form>

        </div>
    </div>
    </div>
    @stop
@section('scripts')
<script>
    $(document).on('click', 'save', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "{{route('ajax.offers.store')}}",

            data: {
                '_token': "{{csrf_token()}}",
                'name_ar': $("input[name='name_ar']").val(),
                'name_en' : $("input[name='name_en']").val(),
                'price' : $("input[name='price']").val(),
                'details_ar' : $("input[name='details_ar']").val(),
                'details_en' : $("input[name='details_en']").val(),
            },
            success: function (data){
            }, error: function (reject){
            }
        });

    });

</script>
    @stop
