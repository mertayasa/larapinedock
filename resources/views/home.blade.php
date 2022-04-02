@extends('layouts.app')

@section('content')
<div class="container" x-data>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1 x-text="$store.text.heading"></h1>
                    <p x-text="$store.text.message"></p>

                    {!! Form::open(['url' => 'submit-form']) !!}
                        {!! Form::label('name', 'Label', ['class' => 'mt-3']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'x-model' => '$store.formData.name']) !!}

                        {!! Form::label('phone', 'Label 2', ['class' => 'mt-3']) !!}
                        {!! Form::text('phone', null, ['class' => 'form-control', 'x-model' => '$store.formData.phone']) !!}
                        
                        {!! Form::label('address', 'Label 2', ['class' => 'mt-3']) !!}
                        {!! Form::textarea('address', null, ['class' => 'form-control', 'x-model' => '$store.formData.address']) !!}
                        
                        {!! Form::label('random_number', 'Label 2', ['class' => 'mt-3']) !!}
                        {!! Form::select('random_number', [0 => 'Please Select', 1 => 'DFG', 2 => 'CAS', 3 => 'TYU'], null, ['class' => 'form-control', 'x-model' => '$store.formData.random_number']) !!}
                        
                        <button class="btn btn-primary mt-3" type="button" x-on:click="$store.formData.generateFormData()">Change Value</button>
                        <button class="btn btn-warning mt-3" type="button" x-on:click="$store.text.changeHeaderText()">Change Header Text</button>
                        <button class="btn btn-success mt-3" type="submit">Submit Form</button>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('formData', {
                name: "{{ old('name', '') }}",
                phone: "{{ old('phone', '') }}",
                address: "{{ old('address', '') }}",
                random_number: "{{ old('random_number', '') }}",

                generateFormData() {
                    fetch('generate-form-data')
                        .then(response => response.json())
                        .then(data => {
                            this.name = data.name;
                            this.phone = data.phone;
                            this.address = data.address;
                            this.random_number = data.random_number;
                        })
                }
            })

            Alpine.store('text', {
                heading: 'I ❤️ Alpine',
                message: 'Here is some text and Alpine will automatically update the DOM when the store changes.',

                changeHeaderText() {
                    this.heading = 'I ❤️ Alpine 2';
                    this.message = 'Here is some text change';
                }
            })
        })
    </script>
@endpush