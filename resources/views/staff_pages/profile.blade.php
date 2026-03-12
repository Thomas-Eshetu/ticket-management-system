<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" type="image/png" href="{{ asset('logo.png') }}">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <title>Staff - View Profile</title>
</head>

<body>
    @include('components.staffNavbar')
    <div class="staffContainer">
        @include('components.staffSidebar')

        <div class="main">
            <h4 class="text-muted">Update Profile</h4>
            <hr>

            <div class="createContainer">

                @if (session('success'))
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: "{{ session('success') }}",
                                confirmButtonColor: '#28a745',
                                timer: 4000,
                                showConfirmButton: false,
                            });
                        });
                    </script>
                @endif

                @if (session('error'))
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Failed!',
                                text: "{{ session('error') }}",
                                confirmButtonColor: '#dc3545',
                                timer: 4000,
                                showConfirmButton: false,
                            });
                        });
                    </script>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('staff.updateProfile') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Full Name:</label>
                            <input type="text" class="form-control" name="name" value="{{ $staff->name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Gender:</label>
                            <select class="form-select" name="gender" id="">
                                <option disabled>Select Gender</option>
                                <option value="male" {{ $staff->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $staff->gender == 'female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Email:</label>
                            <input type="text" class="form-control" name="email" value="{{ $staff->email }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Phone:</label>
                            <input type="text" class="form-control" name="phone" value="{{ $staff->phone }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Department:</label>
                            <input type="text" class="form-control" value="{{ $staff->department }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Position:</label>
                            <input type="text" class="form-control" value="{{ $staff->position }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="" class="form-label">Username:</label>
                            <input type="text" class="form-control" name="username" value="{{ $staff->username }}">
                        </div>
                        <div class="text-end">
                            <button class="btn btn-success">Update <i class="fas fa-edit"></i></button>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>
    <hr>
    <span class="fs-8 text-center d-block">&copy; 2026, All rights reserved!</span>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
</body>

</html>
