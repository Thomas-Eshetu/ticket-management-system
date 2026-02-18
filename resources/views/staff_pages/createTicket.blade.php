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
    <title>Staff - Create Ticket</title>
</head>

<body>
    @include('components.staffNavbar')
    <div class="staffContainer">
        @include('components.staffSidebar')

        <div class="main">
            <h4 class="text-muted">Create Ticket</h4>
            <hr>

            <div class="createContainer">
                <form action="">
                    <lable class="form-label fw-bold">Subject <span class="text-danger">*</span></lable>
                    <input type="text" class="form-control mt-2 mb-2">
                    <lable class="form-label fw-bold mb-2">Department <span class="text-danger">*</span></lable>
                    <input type="text" class="form-control mt-2 mb-2">
                    <lable class="form-label fw-bold">Issue Type <span class="text-danger">*</span></lable>
                    <select name="" id="" class="form-select mt-2 mb-2">
                        <option value="" selected disabled>Select</option>
                        <option value="">Hardware</option>
                        <option value="">Software</option>
                        <option value="">Network</option>
                    </select>
                    <lable class="form-label fw-bold">Issue Start Date/Time <span class="text-danger">*</span></lable>
                    <input type="datetime-local" class="form-control mt-2 mb-2">
                    <lable class="form-label fw-bold">No of Impacted Users <span class="text-danger">*</span></lable>
                    <input type="text" class="form-control mt-2 mb-2">
                    <lable class="form-label fw-bold">Issue Description <span class="text-danger">*</span></lable>
                    <textarea class="form-control mt-2 mb-2" name="" id="" rows="6">
                    </textarea>
                    <div class="text-end">
                        <button type="submit" class="btn btn-success mt-3" style="width: 13rem;">Submit <i
                                class="fa-regular fa-paper-plane ms-2"></i></button>

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
