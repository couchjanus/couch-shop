@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ __('Show product') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                {{ __('Back To List') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ __('Product Id') }}
                        </th>
                        <td>
                            {{ $product->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            
                            {{ __('Product name') }}
                        </th>
                        <td>
                            {{ $product->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Product Status') }}
                        </th>
                        <td>
                            {{ $product->status }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ __('Category') }}
                        </th>
                        <td>
                            {{ $product->category_id }}
                        </td>
                    </tr>
                    
                    <tr>
                        <th>
                            {{ __('Description') }}
                        </th>
                        <td>
                            {{ $product->description }}
                        </td>
                    </tr>
                    
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.products.index') }}">
                    {{ __('Back To List') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection