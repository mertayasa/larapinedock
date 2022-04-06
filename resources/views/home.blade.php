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

                        <table>
                            <tbody>
                                <template x-for="(product, index) in $store.formData.products">
                                    <tr>
                                        <td x-text="product.name" width="30%" class="text-left align-bottom"></td>
                                        <td class="text-left align-bottom" width="20%">
                                            <div class="input-group mt-3">
                                                <span class="input-group-text" style="cursor: pointer" x-on:click="$store.formData.counter == 0 ? false : $store.formData.counter--"> - </span>
                                                {!! Form::text('qty', null, ['class' => 'form-control number-only', 'id' => 'qty', 'x-model' => '$store.formData.counter']) !!}
                                                <span class="input-group-text" style="cursor: pointer" x-on:click="$store.formData.counter++"> + </span>
                                            </div>
                                        </td>
                                        <td class="text-left align-bottom" style="padding-left: 20px" x-on:click.prevent="$store.formData.removeProduct(index)"> <button class="btn btn-sm btn-danger">X</button> </td>
                                    </tr>
                                 </template>
                            </tbody>
                        </table>
                        {{-- <div class="col-2">
                            <div class="input-group mt-3">
                                <span class="input-group-text" style="cursor: pointer" x-on:click="$store.formData.counter == 0 ? false : $store.formData.counter--"> - </span>
                                {!! Form::text('qty', null, ['class' => 'form-control number-only', 'id' => 'qty', 'x-model' => '$store.formData.counter']) !!}
                                <span class="input-group-text" style="cursor: pointer" x-on:click="$store.formData.counter++"> + </span>
                            </div>
                        </div> --}}

                        <style>
                            #qty {
                                text-align: center;
                            }
                        </style>

                        <button class="btn btn-primary mt-3" type="button"
                            x-on:click="$store.formData.generateFormData()">Change Value</button>
                        <button class="btn btn-warning mt-3" type="button" x-on:click="$store.text.changeHeaderText()">Change
                            Header Text</button>
                        <button class="btn btn-success mt-3" type="submit">Submit Form</button>
                        <button type="button" class="btn btn-info mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Launch Modal
                        </button>
                        <button type="button" x-on:click="$store.formData.addProduct()" class="btn btn-secondary mt-3">
                            Add Product
                        </button>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="exampleTable" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>First name</th>
                                    <th>Last name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Tiger</td>
                                    <td>Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                </tr>
                                <tr>
                                    <td>Garrett</td>
                                    <td>Winters</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>63</td>
                                </tr>
                                <tr>
                                    <td>Ashton</td>
                                    <td>Cox</td>
                                    <td>Junior Technical Author</td>
                                    <td>San Francisco</td>
                                    <td>66</td>
                                </tr>
                                <tr>
                                    <td>Cedric</td>
                                    <td>Kelly</td>
                                    <td>Senior Javascript Developer</td>
                                    <td>Edinburgh</td>
                                    <td>22</td>
                                </tr>
                                <tr>
                                    <td>Airi</td>
                                    <td>Satou</td>
                                    <td>Accountant</td>
                                    <td>Tokyo</td>
                                    <td>33</td>
                                </tr>
                                <tr>
                                    <td>Brielle</td>
                                    <td>Williamson</td>
                                    <td>Integration Specialist</td>
                                    <td>New York</td>
                                    <td>61</td>
                                </tr>
                                <tr>
                                    <td>Herrod</td>
                                    <td>Chandler</td>
                                    <td>Sales Assistant</td>
                                    <td>San Francisco</td>
                                    <td>59</td>
                                </tr>
                                <tr>
                                    <td>Rhona</td>
                                    <td>Davidson</td>
                                    <td>Integration Specialist</td>
                                    <td>Tokyo</td>
                                    <td>55</td>
                                </tr>
                                <tr>
                                    <td>Colleen</td>
                                    <td>Hurst</td>
                                    <td>Javascript Developer</td>
                                    <td>San Francisco</td>
                                    <td>39</td>
                                </tr>
                                <tr>
                                    <td>Sonya</td>
                                    <td>Frost</td>
                                    <td>Software Engineer</td>
                                    <td>Edinburgh</td>
                                    <td>23</td>
                                </tr>
                                <tr>
                                    <td>Jena</td>
                                    <td>Gaines</td>
                                    <td>Office Manager</td>
                                    <td>London</td>
                                    <td>30</td>
                                </tr>
                                <tr>
                                    <td>Quinn</td>
                                    <td>Flynn</td>
                                    <td>Support Lead</td>
                                    <td>Edinburgh</td>
                                    <td>22</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    
    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}

    <script>
        $(document).ready( function () {
            $('#exampleTable').DataTable({
                responsive: true
            });
        });

        const numberOnlyInput = document.getElementsByClassName('number-only')
        for (let index = 0; index < numberOnlyInput.length; index++) {
            const numberOnly = numberOnlyInput[index];
            numberOnly.addEventListener('input', function(element){
                element.target.value = element.target.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')
            })
        }
    </script>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('formData', {
                name: "{{ old('name', '') }}",
                phone: "{{ old('phone', '') }}",
                address: "{{ old('address', '') }}",
                random_number: "{{ old('random_number', '') }}",
                counter: "{{ old('counter', '0') }}",
                products: [
                    {
                        id: 1,
                        name: "Product 1",
                        price: 10500,
                    },
                    {
                        id: 2,
                        name: "Product 2",
                        price: 11500,
                    },
                    {
                        id: 3,
                        name: "Product 3",
                        price: 12500,
                    },
                    {
                        id: 4,
                        name: "Product 4",
                        price: 13500,
                    },
                ],

                generateFormData() {
                    fetch('generate-form-data')
                        .then(response => response.json())
                        .then(data => {
                            this.name = data.name;
                            this.phone = data.phone;
                            this.address = data.address;
                            this.random_number = data.random_number;
                        })
                },

                removeProduct(index) {
                    this.products.splice(index, 1)
                },

                addProduct(){
                    this.products.push({
                        id: this.products.length + 1,
                        name: "Product " + (this.products.length + 1),
                        price: Math.floor((Math.random() * 100000) + 1),
                    })
                }
            })

            console.log(Alpine.store('formData').products);

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
