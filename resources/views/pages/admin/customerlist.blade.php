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
                            <th class="align-middle text-center">Aleart</th>
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
                                    {{-- <a class="btn btn-sm btn-primary" href="">Active</a> --}}
                                    @if ( $customer->status == 0)
                                        <span>Active</span>
                                    @elseif($customer->status == 2)
                                        <a class="btn btn-sm btn-primary" href="{{ route('customer.inactive',$customer->id) }}">Active</a>
                                    @else
                                        <a class="btn btn-sm btn-primary" href="{{ route('customer.active',$customer->id) }}" >Inactive</a>
                                    @endif

                                </td>
                                <td class="align-middle text-center">
                                    <a class="btn btn-sm btn-primary" href="">Aleart</a>
                                </td>
                                <td class="align-middle text-center">
                                    @if ( $customer->status == 1 || $customer->status == 3)
                                        <a class="btn btn-sm btn-primary" href="{{ route('customer.delete',$customer->id) }}">Delete</a>
                                    @else
                                        <a class="btn btn-sm btn-primary disabled">Delete</a>
                                        <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ActiveModel{{ $customer->id }}">Inactive</a>
                                    @endif
                                </td>
                            </tr>
                            <!-- Edit modal content -->
                                <div id="ActiveModel{{ $customer->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel">User Registration</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('customer.register') }}" data-parsley-validate novalidate>
                                                    @csrf
                                                        <input type="hidden" name="id" value="{{ $customer->id }}">
                                                        <input type="hidden" name="name" value="{{ $customer->name }}">
                                                        <input type="hidden" name="phone" value="{{ $customer->phone }}">
                                                        <div class="form-group">
                                                            <label>User Id*</label>
                                                            <input type="text" name="net_id" parsley-trigger="change" required
                                                            placeholder="Enter User Id" class="form-control" value="">
                                                        </div>
                                                        @error('net_id')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                        <div class="form-group">
                                                            <label>User password*</label>
                                                            <input type="password" name="password" parsley-trigger="change" required
                                                            placeholder="Enter User password" class="form-control" value="">
                                                        </div>
                                                        @error('password')
                                                            <div class="alert alert-danger">{{ $message }}</div>
                                                        @enderror
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Save</button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                            <!-- /.modal -->
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection