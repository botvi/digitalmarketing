{{-- https://bbbootstrap.com/snippets/bootstrap-profile-card-template-hover-11673763# --}}
<!doctype html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('web') }}/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('web') }}/assets/img/favicon.png">
    <title>
        {{ env('APP_NAME') }}
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- Nucleo Icons -->
    <link href="{{ asset('web') }}/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('web') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset('web') }}/assets/css/font-awesome.css" rel="stylesheet" />
    <link href="{{ asset('web') }}/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ asset('web') }}/assets/css/argon-design-system.css?v=1.2.2" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css">


    {{-- toast --}}
    <!-- Pastikan untuk menambahkan tag ini di dalam bagian head atau sebelum tag </body> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


    <style>
        body {
            background-color: #5957f9;
        }

        .card {
            background-color: #fff;
            width: 580px;
            border-radius: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            padding: 2rem !important;
        }

        .top-container {
            display: flex;
            align-items: center;
        }

        .profile-image {
            border-radius: 10px;
            border: 2px solid #5957f9;
        }

        .name {
            font-size: 15px;
            font-weight: bold;
            color: #272727;
            position: relative;
            top: 8px;
        }

        .mail {
            font-size: 14px;
            color: grey;
            position: relative;
            top: 2px;
        }

        .middle-container {
            background-color: #eee;
            border-radius: 12px;

        }





        .middle-container:hover {
            border: 1px solid #5957f9;
        }

        .dollar-div {
            background-color: #5957f9;
            padding: 12px;
            border-radius: 10px;
        }

        .round-div {
            border-radius: 50%;
            width: 35px;
            height: 35px;
            background-color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .text-rupiah {
            color: #5957f9;
            font-weight: 800;
        }

        .dollar {
            font-size: 16px !important;
            color: #5957f9 !important;
            font-weight: bold !important;
        }


        .deposit-balance {
            font-size: 25px;
            color: #272727;
            font-weight: bold;
        }

        .amount {
            color: #5957f9;
            font-size: 16px;
            font-weight: bold;
        }

        .currency-sign {
            font-size: 16px;
            color: #272727;
            font-weight: bold;
        }





        /* Ganti warna latar belakang header modal */
        .modal-header {
            background-color: #5957f9;
            border-bottom: 1px solid #dee2e6;
        }

        .modal-header .modal-title {
            color: #fff;
        }

        /* Ganti warna latar belakang body modal */
        .modal-body {
            background-color: #fff;
        }

        /* Ganti warna latar belakang footer modal */
        .modal-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
        }

        /* Ganti warna tombol close modal */
        .modal-header .close {
            color: #000;
        }

        /* Ganti warna tombol close modal saat dihover */
        .modal-header .close:hover {
            color: #000;
        }

        /* Ganti warna tombol Save changes */
        .modal-footer .btn-primary {
            background-color: #5957f9;
            border-color: #5957f9;
        }

        /* Ganti warna tombol Save changes saat dihover */
        .modal-footer .btn-primary:hover {
            background-color: #5957f9;
            border-color: #5957f9;
        }

        /* Ganti warna teks pada tombol Save changes */
        .modal-footer .btn-primary:focus {
            box-shadow: 0 0 0 0.2rem #5957f9;
        }

        .btn-primary {
            width: 50%;
            background-color: #5957f9;
            border-color: #5957f9;


        }

        /* Ganti warna tombol Save changes saat dihover */
        .btn-primary:hover {
            background-color: #5957f9;
            border-color: #5957f9;
        }


        /* Ganti warna teks pada tombol Save changes */
        .btn-primary:focus {
            box-shadow: 0 0 0 0.2rem #5957f9;
        }

        .btn-danger {
            width: 20%;
            background-color: #FF8080;
            border-color: #FF8080;
            font-size: 10px
        }

        /* Ganti warna teks pada tombol Save changes */
        .btn-danger:focus {
            box-shadow: 0 0 0 0.2rem #FF8080;
        }

        /* Ganti warna tombol Save changes saat dihover */
        .btn-danger:hover {
            background-color: #FF8080;
            border-color: #FF8080;
        }
    </style>

</head>

<body>
    @include('Website.navbar')

    <div class="container d-flex justify-content-center mt-5">

        <div class="card">
            <div class="top-container row">
                <div class="col-12 col-sm-auto">
                    <img src="https://assets-a1.kompasiana.com/items/album/2021/03/24/blank-profile-picture-973460-1280-605aadc08ede4874e1153a12.png"
                        class="img-fluid profile-image" width="70">
                </div>
                <div class="col">
                    @if (auth()->check())
                        <div style="display: flex; align-items: center;">
                            <h5 class="name" id="editableName">{{ auth()->user()->name }}</h5>
                            <button onclick="editName()"
                                style="background: none; border: none; color:#5957f9; margin-left: 5px;">
                                <i class="fas fa-edit fa-lg"></i>
                            </button>
                            <button onclick="saveName()"
                                style="display:none; background: none; border: none; color:#74E291;">
                                <i class="fas fa-save fa-lg"></i>
                            </button>
                        </div>


                        <p class="mail">{{ auth()->user()->email }}</p>
                        <span class="badge badge-success" data-toggle="modal" data-target="#changePasswordModal">
                            Change password <i class="fas fa-key"></i>
                        </span>
                    @endif
                    <a href="/logout" class="badge badge-danger">
                        Logout <i class="fas fa-power-off"></i>
                    </a>
                </div>
            </div>


            <div class="middle-container d-flex justify-content-between align-items-center mt-3 p-2">
                <div class="dollar-div px-3">

                    @if (auth()->check())
                        @if (auth()->user()->currency === 'IDR')
                            <div class="round-div text-rupiah">Rp</div>
                        @else
                            <div class="round-div"><i class="fa fa-dollar dollar"></i></div>
                        @endif
                    @endif

                </div>
                <div class="d-flex flex-column text-right mr-2">
                    <span class="current-balance" style="font-weight: 700;">Current Balance</span>
                    <span class="amount">
                        @if (auth()->check())
                            @if (auth()->user()->currency === 'USD')
                                <span class="currency-sign">$
                                </span>{{ auth()->user()->balance_usd ? number_format(auth()->user()->balance_usd, 2) : '-' }}
                            @else
                                <span class="currency-sign">IDR
                                </span>{{ auth()->user()->balance_idr ? number_format(auth()->user()->balance_idr) : '-' }}
                            @endif
                        @else
                            <span class="currency-sign">$</span>0
                        @endif
                    </span>
                </div>
                <div class="d-flex flex-column text-left mr-2">
                    @if (auth()->user()->currency == 'USD')
                        <a href="/deposit_usd" class="deposit-balance">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                            <i class="fa fa-plus" aria-hidden="true" style="font-size: 20px;"></i>
                        </a>
                    @elseif(auth()->user()->currency == 'IDR')
                        <a href="/deposit_idr" class="deposit-balance">
                            <i class="fa fa-credit-card" aria-hidden="true"></i>
                            <i class="fa fa-plus" aria-hidden="true" style="font-size: 20px;"></i>
                        </a>
                    @endif
                </div>


            </div>
            <center>
                <a href="/history" class="btn btn-primary mt-4">BALANCE HISTORY</a>
            </center>



            <!-- Modal -->
            <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="passwordForm">
                                <div class="form-group">
                                    <label for="currentPassword">Current Password</label>
                                    <input type="password" class="form-control" id="currentPassword"
                                        name="currentPassword" required>
                                </div>
                                <div class="form-group">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" class="form-control" id="newPassword" name="newPassword"
                                        required minlength="8">
                                </div>
                                <div class="form-group">
                                    <label for="confirmNewPassword">Confirm New Password</label>
                                    <input type="password" class="form-control" id="confirmNewPassword"
                                        name="confirmNewPassword" required minlength="8">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="updatePassword()">Save
                                changes</button>
                        </div>
                    </div>
                </div>
            </div>




        </div>

    </div>


    {{-- SCRRIPT --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--   Core JS Files   -->
    <script src="{{ asset('web') }}/assets/js/core/jquery.min.js" type="text/javascript"></script>
    <script src="{{ asset('web') }}/assets/js/core/popper.min.js" type="text/javascript"></script>
    <script src="{{ asset('web') }}/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
    <script src="{{ asset('web') }}/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="{{ asset('web') }}/assets/js/plugins/bootstrap-switch.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('web') }}/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
    <script src="{{ asset('web') }}/assets/js/plugins/moment.min.js"></script>
    <script src="{{ asset('web') }}/assets/js/plugins/datetimepicker.js" type="text/javascript"></script>
    <script src="{{ asset('web') }}/assets/js/plugins/bootstrap-datepicker.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <!-- Control Center for Argon UI Kit: parallax effects, scripts for the example pages etc -->
    <!--  Google Maps Plugin    -->
    {{-- <script src="{{ asset('web') }}/assets/js/argon-design-system.min.js?v=1.2.2" type="text/javascript"></script> --}}
    @include('sweetalert::alert')



    {{-- SCRIPT --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

    <script>
        function editName() {
            var nameElement = document.getElementById('editableName');
            var editButton = document.querySelector('button[onclick="editName()"]');
            var saveButton = document.querySelector('button[onclick="saveName()"]');
            var currentName = nameElement.textContent.trim();
            var inputElement = document.createElement('input');
            inputElement.setAttribute('type', 'text');
            inputElement.setAttribute('value', currentName);
            nameElement.innerHTML = '';
            nameElement.appendChild(inputElement);
            editButton.style.display = 'none';
            saveButton.style.display = 'inline-block';
            inputElement.focus();
        }

        function saveName() {
            var nameElement = document.getElementById('editableName');
            var editButton = document.querySelector('button[onclick="editName()"]');
            var saveButton = document.querySelector('button[onclick="saveName()"]');
            var newName = nameElement.querySelector('input').value.trim();
            var userId = '{{ auth()->user()->id }}';
            $.ajax({
                url: '/profile/update',
                method: 'POST', // Ubah menjadi POST
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _method: 'PUT', // Tambahkan ini untuk mengatasi keterbatasan form HTML
                    id: userId,
                    name: newName
                },
                success: function(response) {
                    console.log('Name updated successfully:', response);
                    nameElement.innerHTML = newName;
                    editButton.style.display = 'inline-block';
                    saveButton.style.display = 'none';

                    // Tampilkan pesan sukses menggunakan Toastify
                    Toastify({
                        text: 'Name updated successfully!',
                        duration: 3000,
                        gravity: 'top',
                        position: 'right',
                        backgroundColor: '#74E291', // Gunakan warna yang sesuai untuk pesan sukses
                        stopOnFocus: true
                    }).showToast();
                },

                error: function(xhr, status, error) {
                    console.error('Error updating name:', error);
                    Toastify({
                        text: 'Failed to update name. Please try again.',
                        duration: 3000, // Durasi pesan (dalam milidetik)
                        gravity: 'top', // Letak pesan
                        position: 'right', // Posisi pesan
                        backgroundColor: '#FF8080', // Warna latar belakang pesan
                        stopOnFocus: true // Berhenti ketika elemen berfokus
                    }).showToast();
                }

            });



        }
    </script>

    <script>
        function updatePassword() {
            var currentPassword = $('#currentPassword').val();
            var newPassword = $('#newPassword').val();
            var confirmNewPassword = $('#confirmNewPassword').val();

            // Validasi bahwa kata sandi baru dan konfirmasi kata sandi baru cocok
            if (newPassword !== confirmNewPassword) {
                Toastify({
                    text: 'New password and confirm new password do not match.',
                    backgroundColor: '#FF8080',
                    className: 'error',
                }).showToast();
                return;
            }

            // Kirim permintaan AJAX untuk memperbarui kata sandi
            $.ajax({
                url: '{{ route('profile.updatePassword') }}',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    currentPassword: currentPassword,
                    newPassword: newPassword,
                    confirmNewPassword: confirmNewPassword
                },
                success: function(response) {
                    console.log('Password updated successfully:', response);
                    // Tampilkan pesan sukses menggunakan Toastify
                    Toastify({
                        text: 'Password updated successfully.',
                        backgroundColor: '#74E291',
                        className: 'info',
                    }).showToast();
                    // Tutup modal setelah pembaruan berhasil
                    $('#changePasswordModal').modal('hide');
                    // Reset nilai input
                    $('#currentPassword').val('');
                    $('#newPassword').val('');
                    $('#confirmNewPassword').val('');
                    // Reload halaman untuk memperbarui data
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error('Error updating password:', error);
                    // Tampilkan pesan kesalahan menggunakan Toastify
                    Toastify({
                        text: 'Failed to update password. Please try again.',
                        backgroundColor: '#FF8080',
                        className: 'error',
                    }).showToast();
                }
            });
        }
    </script>


</body>

</html>
