@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card-box table-responsive">
                <div class="d-flex justify-content-between">
                    <h1 class="m-t-0 w-100 text-center"><b>{{ $heading }}</b></h1>
                </div>

                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="align-middle text-center">Sl.</th>
                            <th class="align-middle text-center">Name</th>
                            <th class="align-middle text-center">Email</th>
                            <th class="align-middle text-center">Phone</th>
                            <th class="align-middle text-center"> User ID</th>
                            <th class="align-middle text-center">Status</th>
                            <th class="align-middle text-center">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                            <tr>
                                <td class="align-middle text-center">{{ ++$loop->index }}</td>
                                <td class="align-middle text-center">{{ $customer->name }}</td>
                                <td class="align-middle text-center">{{ $customer->email }}</td>
                                <td class="align-middle text-center">{{ $customer->phone }}</td>
                                <td class="align-middle text-center">{{ $customer->user_id }}</td>
                                <td class="align-middle text-center">
                                    @if ($customer->status == 0)
                                        Inactive
                                    @else
                                        Active
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection