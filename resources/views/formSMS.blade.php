@extends('layouts.layout2')
@section('title', 'Envoi mail ')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">

                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    <div class="panel-heading">
                        <h3 class="panel-title">Envoi SMS</h3>
                    </div>
                    <div class="panel-body">
                        <form id="myForm" method="POST" action="{{ route('sendMessage') }}" role="form">
                            {{csrf_field()}}
                            <fieldset>

                            <input type="hidden" name="IdMedecin" value="{{$medecin->id}}">
                            
                            <input type="hidden" name="phone_number" value="{{$medecin->gsm }}" >
                                <label for="message" class="col-form-label">Message :</label>
                                <div class="form-group">
        
                                    <textarea rows="10" cols="60" class="form-control" placeholder="Your Message" name="message" autofocus> </textarea></div>
                                    
                                
                                <!-- Change this to a button or input when using this as a form -->
                                <div class="col-md-12 submitSms">
                                <button id="submitBtn" type="submit" class="btn btn-success">Send Message</button>
                                <a href="{{route('showMedecin',$medecin->id)}}" class="btn btn-danger btn-rechercher">Retour </a>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- /.container -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
    $('#myForm').submit(function(){
        $('#submitBtn').html('Sending...');
    });
</script>
@endsection