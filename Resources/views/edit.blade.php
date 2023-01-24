@extends('layouts.admin')

@push('stylesheets')
    <style>
        .properties {
            display: flex;
            flex-wrap: wrap;
        }
    </style>
@endpush

@section('content')
    <!-- CONTAINER -->
    <div class="main-container container-fluid">
        <!-- PAGE-HEADER -->
    @include('tariffs::partial.header')
    <!-- PAGE-HEADER END -->

        <!-- ROW -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">ویرایش تعرفه</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('tariffs.update', $tariff->id) }}" method="post" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                            <div class="col-md-6">
                                <label for="title" class="form-label">عنوان</label>
                                <input type="text" name="title" class="form-control" id="title" required value="{{ $tariff->title }}">
                                <div class="invalid-feedback">لطفا عنوان را وارد کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="sub_title" class="form-label">زیر عنوان</label>
                                <input type="text" name="sub_title" class="form-control" id="sub_title" required value="{{ $tariff->sub_title }}">
                                <div class="invalid-feedback">لطفا زیر عنوان را وارد کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label">قیمت</label>
                                <input type="text" name="price" class="form-control" id="price" required value="{{ $tariff->price }}">
                                <div class="invalid-feedback">لطفا قیمت را وارد کنید</div>
                            </div>
                            <div class="col-md-6">
                                <label for="day" class="form-label">تعداد روز</label>
                                <input type="text" name="day" class="form-control" id="day" required value="{{ $tariff->day }}">
                                <div class="invalid-feedback">لطفا تعداد روز را وارد کنید</div>
                            </div>

                            <div class="col-md-12">
                                <label for="day" class="form-label">افزودن ویژگی</label>
                                <button type="button" class="btn btn-success add-property"><i class="fa fa-plus"></i> افزودن</button>
                                <div class="invalid-feedback">لطفا تعداد روز را وارد کنید</div>
                            </div>

                            <div class="properties">
                                @if($tariff->properties)
                                    @php
                                        $properties = unserialize($tariff->properties);
                                    @endphp
                                    @foreach($properties as $property)
                                        <div class="col-md-6">
                                            <label for="properties" class="form-label">ویژگی</label>
                                            <input type="text" name="properties[]" class="form-control" value="{{ $property }}">
                                            <div class="invalid-feedback">لطفا ویژگی را وارد کنید</div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>


                            <div class="col-12">
                                <button class="btn btn-primary" type="submit">ارسال فرم</button>
                                @csrf
                                @method('PATCH')
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW CLOSED -->

    </div>

    @push('scripts')
        <script>
            $('.add-property').click(function (){
                $('.properties').append('<div class="col-md-6">' +
                    '<label for="properties" class="form-label">ویژگی</label>' +
                    '<input type="text" name="properties[]" class="form-control">' +
                    '<div class="invalid-feedback">لطفا ویژگی را وارد کنید</div>' +
                    '</div>');
            });
        </script>
    @endpush
@endsection
