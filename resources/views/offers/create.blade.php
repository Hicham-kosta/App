<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">{{__('messages.Language')}}</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <li class="nav-item">
                        <a class="nav-link"  href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">{{ $properties['native'] }}</a>
                    </li>
                    @endforeach

                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="{{__('messages.Search')}}" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">{{__('messages.Search')}}</button>
                </form>
            </div>
        </div>
    </nav>
        <div class="flex-center position-ref full-height">

            <div class="content">
                <div class="title m-b-md">
                    {{__('messages.Add Your Offer')}}
                </div>
                @if(Session::has('success')) {{--Session--}}
                    <div class="alert alert-success" role="alert">
                        {{Session::get('success')}}

                    </div>
                @endif
                <form method="POST" action="{{route('offers.store')}}" enctype="multipart/form-data">
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

                    <button type="submit" class="btn btn-primary">{{__('messages.Save')}}</button>
                </form>

                </div>
            </div>
    </body>
</html>
