@extends('layouts.app')

@section('content')

    <div class="alert alert-success" id="success_msg" style="display: none">
        Offer deleted successfully
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">{{__('messages.Offer Name')}}</th>
            <th scope="col">{{__('messages.Offer Price')}}</th>
            <th scope="col">{{__('messages.Offer Details')}}</th>
            <th scope="col">{{__('messages.Offer photo')}}</th>
            <th scope="col">{{__('messages.Operation')}}</th>
        </tr>
        </thead>
        <tbody>

        @foreach($offers as $offer)
            <tr class="offerRow{{$offer -> id}}"> {{--class to specify all column for delete it immediatly--}}
                <th scope="row">{{$offer -> id}}</th>
                <td>{{$offer -> name}}</td>
                <td>{{$offer -> price}}</td>
                <td>{{$offer -> details}}</td>
                <td><img style="..." src="{{asset('images/offers/'.$offer -> photo)}}"></td>
                <td><a href="{{url('offers/edit/',$offer -> id)}}" class="btn btn-success">{{__('messages.update')}}</a></td>
                <td><a href="{{route('offers.delete',$offer -> id)}}" class="btn btn-danger">{{__('messages.delete')}}</a></td>

                <td><a href="" offer_id="{{$offer -> id}}" class="delete_btn btn btn-danger">delete ajax</a></td>
                <td><a href="{{route('ajax.offers.edit',$offer -> id)}}" class="btn btn-success">update ajax</a></td
            </tr>
        @endforeach

        </tbody>
    </table>
@stop

@section('scripts')
    <script>
        $(document).on('click', '.delete_btn', function(e){
            e.preventDefault();
            var offer_id = $(this).attr('offer_id')

            $.ajax({
                type: 'post',
                url: "{{route('ajax.offers.delete')}}",
                data: {
                '_token' : "{{csrf_token()}}",
                    'id' : offer_id
                },
                success: function (data){
                    if(data.status == true){
                        $('#success_msg').show();
                    }
                    $('.offerRow'+data.id).remove();

                }, error: function (reject){
                }
            });

        });

    </script>
@stop
