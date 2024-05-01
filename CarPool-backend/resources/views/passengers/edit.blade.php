@extends('/base')
@section('body')
    <!-- Main Content -->
    <div id="content">

        <div class="container">
            <h1>Passenger Detail</h1>

            <form class="form" method="post" action="/performEdit/{{ $passenger->id }}" enctype="multipart/form-data">
                @csrf
                @method('put')

                {{-- Profile Img --}}
                <div class="row col-sm-12 my-5">
                    <div class="form-group w-25 h-auto m-auto">
                        {{-- <label for="studentCard" class="upload">Student Card: --}}
                        {{-- <input type="file" class="form-control" id="studentCard" placeholder="Insert Student Card"
                    name="studentCard" hidden> --}}

                        <img src="/profileImg/{{ $passenger->profileImg }}" class="rounded-circle shadow-4-strong"
                            width="100%" height="100%">
                        </label>
                    </div>
                </div>

                {{-- Email Name --}}
                <div class="row col-sm-12">
                    <div class="col-sm-6 col-sm-offset-1">
                        <div class="form-group">
                            <label for="email">Student Email:</label>
                            <input type="text" class="form-control" id="email" placeholder="Enter Email"
                                name="email" value="{{ old('email', $passenger) }}" readonly>
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-sm-6 col-sm-offset-1">
                        <div class="form-group">
                            <label for="name">Student Name:</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter Name"
                                name="name" value="{{ old('name', $passenger) }}" readonly>
                        </div>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                {{-- Gender, Contact No --}}
                <div class="row col-sm-12">
                    <div class="col-sm-6 col-sm-offset-1">
                        <div class="form-group">
                            <label for="gender">Gender:</label>
                            <input type="text" class="form-control" id="gender" placeholder="Enter Gender"
                                name="gender" value="{{ old('gender', $passenger) }}" readonly>
                        </div>
                        @error('gender')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 col-sm-offset-1">
                        <div class="form-group">
                            <label for="contactNo">Contact No:</label>
                            <input type="text" class="form-control" id="contactNo" placeholder="Enter Contact No"
                                name="contactNo" value="{{ old('contactNo', $passenger) }}" readonly>
                        </div>
                        @error('contactNo')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                {{-- Student Card Exp Date, Status --}}
                <div class="row col-sm-12">
                    <div class="col-sm-6 col-sm-offset-1">
                        <div class="form-group">
                            <label for="studentCardExpDate">Student Card Expired Date:(YYYY-MM-DD)</label>
                            <input type="text" class="form-control" id="studentCardExpDate"
                                placeholder="Enter Student Card Expired Date" name="studentCardExpDate"
                                value="{{ old('studentCardExpDate', $passenger) }}" readonly>
                        </div>
                        @error('studentCardExpDate')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 col-sm-offset-1">
                        {{-- Dropdown field to update status --}}
                        <div class="form-group">
                            <label for="passengerStatus">Status:</label>
                            <select name="passengerStatus" id="passengerStatus" class="form-control">
                                <option value="Pending Approval"
                                    {{ old('passengerStatus', $passenger) == 'Pending Approval' ? 'selected' : '' }}>
                                    Pending
                                    Approval
                                </option>
                                <option value="Approved"
                                    {{ old('passengerStatus', $passenger) == 'Approved' ? 'selected' : '' }}>
                                    Approved
                                </option>
                                <option value="Rejected"
                                    {{ old('passengerStatus', $passenger) == 'Rejected' ? 'selected' : '' }}>
                                    Rejected
                                </option>
                            </select>
                        </div>
                    </div>

                </div>

                {{-- Student Card, Remark --}}
                <div class="row col-sm-12">
                    <div class="col-sm-6 col-sm-offset-1">
                        <div class="form-group w-50 h-auto">
                            <label for="studentCard" class="upload">Student Card:
                                {{-- <input type="file" class="form-control" id="studentCard" placeholder="Insert Student Card"
                                    name="studentCard" hidden> --}}
                            </label>
                            <img src="/studentCard/{{ $passenger->studentCard }}" class="rounded" width="100%"
                                height="100%">

                        </div>
                        @error('studentCard')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-sm-6 col-sm-offset-1">
                        <div class="form-group">
                            <label for="remark">Remark: (optional)</label>
                            <textarea class="form-control" id="remark" name="remark" rows="4" maxlength="255">{{ old('remark', $passenger) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="my-5">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>

        </div>
    </div>
    <!-- End of Main Content -->
@endsection
