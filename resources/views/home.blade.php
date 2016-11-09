@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Clients</div>

                <div class="panel-body">                    
                    <div class="col-md-6">
                        <legend>Client List</legend>
                        @if (isset($clients) && !empty($clients))
                              <div class="alert alert-success" id="removal_success" style="display:none">Client successfully removed.</div>
                              <div class="alert alert-error" id="removal_success" style="display:none">There was a problem removing the client.</div>
                                <div class="col-md-12">
                                <table class="table table-striped" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>IP/Range</th>
                                        <th>Description</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td title="{{ $client->description }}">{{ $client->name }}</td>
                                            <td>{{ $client->ip_address_start . ($client->ip_address_end ? ' - '. $client->ip_address_end: '')}}</td>
                                            <td>{{ $client->description }}</td>
                                            <td class="text-center">
                                                <a class='btn btn-info btn-xs edit_client' href="/client/edit/{{ $client->id }}"> Edit</a> 
                                                <a href="/client/requests/{{ $client->id }}" class="btn btn-success btn-xs view_requests"> Requests</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                </div>

                            {{ $clients->links() }}
                        @else
                            <div class="alert alert-info">No clients found. Start by addding some clients.</div>
                        @endif
                    </div>
                    <div class="col-md-6" style="border-left: 1px solid #e0e0e0;">
                        <form id="client_form" name="client_form" method="POST" action="/client/save" class="form-horizontal">
                            <fieldset>
                            <?php echo csrf_field();?>
                            <!-- Form Name -->
                            <legend>Add Client</legend>
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
                              <input id="name" name="name" type="text" placeholder="Name" class="form-control input-md" value="{{ old('name') }}" required>
                                
                              </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="description">Description</label>  
                              <div class="col-md-8">
                              <input id="description" name="description" type="text" placeholder="Description" class="form-control input-md" value="{{ old('description') }}">
                                
                              </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="ip_address_start">IP Address</label>  
                              <div class="col-md-8">
                              <input id="ip_address_start" name="ip_address_start" type="text" placeholder="IP Address" class="form-control input-md" value="{{ old('ip_address_start') }}" required>
                                
                              </div>
                            </div>

                            <!-- Text input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="ip_address_end">IP Address End<i style="font-size: 10px;display: block; margin-top: -3px;">(Only when using a range)</i></label>  
                              <div class="col-md-8">
                              <input id="ip_address_end" name="ip_address_end" type="text" placeholder="IP Address end" class="form-control input-md" value="{{ old('ip_address_end') }}">
                                
                              </div>
                            </div>

                            <!-- Password input-->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="password">Password </label>
                              <div class="col-md-8">
                                <input id="password" name="password" type="text" placeholder="Password" class="form-control input-md" value="{{ old('password') }}">
                                
                              </div>
                            </div>

                            <!-- Button (Double) -->
                            <div class="form-group">
                              <label class="col-md-4 control-label" for="button1id"> </label>
                              <div class="col-md-8">
                                <button id="save"  class="btn btn-success">Save</button>
                                <button id="stop_editing" type="button" class="btn btn-primary" style="display:none">Stop Editing</button>
                              </div>
                            </div>

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('my_css')
<style type="text/css">
    .btn-xs  {
        width: 95%;
        margin: 3px 0;
    }
</style>
@endsection
