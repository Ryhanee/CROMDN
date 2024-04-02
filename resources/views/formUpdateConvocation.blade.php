<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
​
        <title>Laravel</title>
​
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
​
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{ asset('js/utilities.js') }}"></script>
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
​
            .full-height {
                height: 20vh;
            }
​
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
​
            .position-ref {
                position: relative;
            }
​
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
​
            .content {
                text-align: center;
            }
​
            .title {
                font-size: 45px;
            }
​
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
​
            .m-b-md {
                margin:20px;
            }
​
            h1
            {
               margin-top: 20PX;
            }
        </style>
    </head>
    <body>
    <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ route('logout') }}">Logout</a>
                        <a href="{{ url('/home') }}">Home</a>
                        <a href="#">Profil</a>
                    @endauth
                </div>
            @endif
    </div>
        <div class="content">
            <center><H1><strong>N° Plainte {{$convocation->id_plainte}}</strong></H1></center>
            <section >
                <div class="container">
            <!-- Formulaire d'ajout   --->
​
            <form class="row" action="{{ route('updateConvocation',$convocation->id) }}" method="POST">
            @csrf
                <div class="col-md-6 firstlot">
​
​
                      <div class="form-group row">
​
                        <label for="date" class=" col-form-label">date</label>
                        <div class="col-sm-8">
                          <input type="date"  class="form-control" id="date" name="date" value="{{ $convocation->date}}">
                        </div>
                      </div>
​
                      <div class="form-group row">
​
                        <label for="sanction" class=" col-form-label">sanction</label>
                 <div class="col-sm-8">
                     <select class="form-control" id="sanction" name="sanction">
​
                         @foreach($sanctions as $sanction)
​
                             @if($sanction->id===$convocation->sanction)
                             <option  value="{{$sanction->id}}" selected>{{$sanction->libelle}} </option>
                             @else
                             <option value="{{$sanction->id}}"> {{$sanction->libelle}} </option>
                             @endif
​
                         @endforeach
                     </select>
​
                 </div>
​
                 </div>
​
​
​
                          <div class="form-group row">
                        <label for="observation" class=" col-form-label">observation</label>
                        <div class="col-sm-8">
                          <input type="text" class="form-control" id="observation" placeholder="" name="observation" value="{{ $convocation->observation}}">
                        </div>
                      </div>
​
​
​
​
​
        </div>
​
                <div class="col-md-12 submit-center">
​
                 <button type="submit" class="btn btn-primary btn-rechercher">Enregistrer</button>
                </div>
            </form>
​
                <!-- FIN de formulaire   --->
                </div>
                </section>
​
        </div>
        <script src="{{ asset('js/index.js') }}"></script>
    </body>
​
​
</html>