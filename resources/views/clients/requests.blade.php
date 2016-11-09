@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                	Client Requests
                	<a class="btn btn-xs pull-right" href="/">Back</a>
                </div>

                <div class="panel-body">                    
                    <div class="col-md-12">
                        <legend>Requests {{ (isset($client_requests->client))? 'for '.$client_requests->client->name: '' }}</legend>
                        @if (isset($client_requests) && count($client_requests) > 0)
                              <div class="alert alert-success" id="removal_success" style="display:none">Client successfully removed.</div>
                              <div class="alert alert-error" id="removal_success" style="display:none">There was a problem removing the client.</div>
                                <div class="col-md-12">
                                <table class="table table-striped" style="font-size: 12px;">
                                <thead>
                                    <tr>
                                        <th>Date & Time</th>
                                        <th>Request</th>
                                        <th>Response</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                    @foreach ($client_requests as $client_request)
                                        <tr>
                                            <td>{{ $client_request->created_at }}</td>
                                            <td>{{ $client_request->request_string }}</td>
                                            <td>{{ $client_request->response_string }}</td>
                                            <td>{{ $client_request->response_status }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                                </div>

                            {{ $client_requests->links() }}
                        @else
                            <div class="alert alert-info">No requests found.</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection