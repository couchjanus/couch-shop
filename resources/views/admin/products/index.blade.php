@extends('layouts.admin')
@section('content')

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route("admin.products.create") }}">
            {{ __('Add product') }}
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ __('Product List') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-product">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ __('product id') }}
                        </th>
                        <th>
                            {{ __('product name') }}
                        </th>
                        <th>
                            {{ __('Created At') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $key => $product)
                    <tr data-entry-id="{{ $product->id }}">
                        <td>

                        </td>
                        <td>
                            {{ $product->id ?? '' }}
                        </td>
                        <td>
                            {{ $product->name ?? '' }}
                        </td>

                        <td>
                            {{ $product->created_at ?? '' }}
                        </td>

                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('admin.products.show', $product->id) }}">

                                {{ __('view') }}
                            </a>

                            <a class="btn btn-xs btn-info" href="{{ route('admin.products.edit', $product->id) }}">
                                {{ __('edit') }}
                            </a>
                            
                            <form action="{{ route('admin.products.destroy',  $product->id) }}" method="post" style="display: inline-block;">@method('DELETE') @csrf
                                <button title="Delete product" type="submit" class="btn btn-xs btn-danger">{{ __('delete') }}</button>
                            </form> 
                            
                        </td>

                    </tr>
                    @empty
                        <p>No products yet...</p>
                    @endforelse
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>
</div>

@endsection
@section('scripts')
@parent

@endsection
