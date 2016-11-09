@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	Clients
                	<a class="btn btn-xs pull-right" href="/">Back</a>
                </div>

                <div class="panel-body"> 
                        <form id="client_form" name="client_form" method="POST" action="/client/update/{{ $client->id }}" class="form-horizontal">
                            <fieldset>
                            <?php echo csrf_field();?>
                            <!-- Form Name -->
                            <legend>Edit Client</legend>
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="name">Name</label>  
                              <div class="col-md-8">
                              <input id="name" name="name" type="text" placeholder="Name" class="form-control input-md" value="{{ old('name') ?: $client->name ?: '' }}" required>
                                
                              </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="description">Description</label>  
                              <div class="col-md-8">
                              <input id="description" name="description" type="text" placeholder="Description" class="form-control input-md" value="{{ old('description') ?:  $client->description ?: '' }}">
                                
                              </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="ip_address_start">IP Address</label>  
                              <div class="col-md-8">
                              <input id="ip_address_start" name="ip_address_start" type="text" placeholder="IP Address" class="form-control input-md" value="{{ old('ip_address_start') ?: $client->ip_address_start ?: '' }}" required>
                                
                              </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="ip_address_end">IP Address End<i style="font-size: 10px;display: block; margin-top: -3px;">(Only when using a range)</i></label>  
                              <div class="col-md-8">
                              <input id="ip_address_end" name="ip_address_end" type="text" placeholder="IP Address end" class="form-control input-md" value="{{old('ip_address_end') ?: $client->ip_address_end ?: '' }}">
                                
                              </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="password">Password </label>
                              <div class="col-md-8">
                                <input id="password" name="password" type="text" placeholder="Password" value="{{ $client->password ?: '' }}" class="form-control input-md">
                                
                              </div>
                            </div>

                            <!-- Button (Double) -->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="button1id"> </label>
                              <div class="col-md-8">
                              	<button id="save" class="btn btn-success">Update</button>
                              </div>
                            </div>

                            </fieldset>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection