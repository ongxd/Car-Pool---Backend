@extends('/base')
@section('body')

    <head>
        <title>SB Admin 2 - Tables</title>
    </head>

    <!-- Main Content -->
    <div id="content">


        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Passengers List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Contact No</th>
                                <th>Passenger Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Email</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Contact No</th>
                                <th>Passenger Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <!--Check if the table is empty-->
                            @if ($passengers->count() == 0)
                                <td colspan="6" style="background-color:#f2f2f2;text-align: center; ">
                                    <h6>No Records Found</h6>
                                </td>
                            @endif

                            @foreach ($passengers as $passenger)
                                <tr>
                                    <td>{{ $passenger->email }}</td>
                                    <td>{{ $passenger->name }}</td>
                                    <td>{{ $passenger->gender }}</td>
                                    <td>{{ $passenger->contactNo }}</td>
                                    <td>{{ $passenger->passengerStatus }}</td>
                                    <td>
                                        <a href="/edit/{{ $passenger->id }}" class="mx-2"><i class='fas fa-eye'
                                                style='font-size:24px'></i></a>
                                        <a href="" class="text-danger mx-2"><i class='fa fa-trash'
                                                style='font-size:24px'></i></a>
                                    </td>
                                </tr>
                            @endforeach



                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- End of Main Content -->
@endsection
