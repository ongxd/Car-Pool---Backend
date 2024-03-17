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
                <h6 class="m-0 font-weight-bold text-primary">Passenger List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Contact No</th>
                                <th>Student Card</th>
                                <th>profile Image</th>
                                <th>Passenger Status</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Email</th>
                                <th>Gender</th>
                                <th>Contact No</th>
                                <th>Student Card</th>
                                <th>profile Image</th>
                                <th>Passenger Status</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <!--Check if the table is empty-->
                            @if ($passengers->count() == 0)
                                <td colspan="6" style="background-color:#f2f2f2;text-align: center; ">
                                    <h6>No Records Found</h6>
                                </td>
                            @endif
                            <tr>
                                @foreach ($passengers as $passenger)
                                    <td>{{ $passenger->email }}</td>
                                    <td>{{ $passenger->gender }}</td>
                                    <td>{{ $passenger->contactNo }}</td>
                                    <td>{{ $passenger->studentCard }}</td>
                                    <td>{{ $passenger->profileImg }}</td>
                                    <td>{{ $passenger->passengerStatus }}</td>
                                @endforeach
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- End of Main Content -->
@endsection
