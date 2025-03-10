@extends('layouts.app')

@section('page-title', __('Manage Priority'))
@php
    $logos = \App\Models\Utility::get_file('uploads/profile/');
@endphp
@section('action-button')
    <div class="float-end">
        <div class="col-auto=">
            <a href="javascript:void(0)" class="btn btn-sm btn-primary mx-1" data-ajax-popup="true" data-size="md"
                data-title="{{ __('Create Priority') }}" data-url="{{ route('priority.create') }}"
                data-toggle="tooltip" title="{{ __('Create Priority') }}"
                data-bs-original-title="{{ __('Create Priority') }}" data-bs-placement="top"
                data-bs-toggle="tooltip">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    </div>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Manage Priority') }}</li>
@endsection

@section('content')
    <div class="col-sm-12">
        <div class="row g-0">
            <div class="col-xl-3 border-end border-bottom">
                @include('layouts.setup')
            </div>
            <div class="col-xl-9" data-bs-spy="scroll" data-bs-target="#useradd-sidenav" data-bs-offset="0" tabindex="0">
                <div class="card shadow-none rounded-0 border-bottom" id="useradd-1">
                    <div class="card-body pb-0">
                        <div class="table-responsive">
                            <table id="DataTables_Table_0" class="table dataTable data-table user-datatable no-footer">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('Name') }}</th>
                                        <th scope="col">{{ __('Color') }}</th>
                                        <th scope="col" class="text-end me-3">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
    
                                <tbody>
                                    @foreach ($priority as $index => $priorities)
                                        <tr>
                                            <th scope="row">{{ ++$index }}</th>
                                            <td>{{ $priorities->name }}</td>
                                            <td><span class="badge"
                                                    style="background: {{ $priorities->color }}">&nbsp;&nbsp;&nbsp;</span></td>
    
                                            <td class="text-end">
                                                    <div class="action-btn bg-light-secondary ms-2">
                                                        <a href="javascript:void(0)" class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                            title="{{ __('Edit') }}" data-bs-toggle="tooltip"
                                                            data-bs-placement="top"
                                                            data-url="{{ route('priority.edit', $priorities->id) }}"
                                                            data-ajax-popup="true" data-title="{{ __('Edit Category') }}"
                                                            data-size="md"><span><i
                                                                    class="ti ti-edit"></i></span></a>
    
                                                    </div>
                                                    <div class="action-btn bg-light-secondary ms-2">
                                                        <a href="#"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center bs-pass-para"
                                                            data-confirm="{{ __('Are You Sure?') }}"
                                                            data-confirm-yes="delete-form-{{ $priorities->id }}"
                                                            title="{{ __('Delete') }}" data-bs-toggle="tooltip"
                                                            data-bs-placement="top">
                                                            <i class="ti ti-trash"></i>
                                                        </a>
                                                    </div>
                                                
                                                    {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['priority.destroy', $priorities->id],
                                                        'id' => 'delete-form-' . $priorities->id,
                                                    ]) !!}
                                                    {!! Form::close() !!}
                                                    
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
