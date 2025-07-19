        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>SI MANTAP |</title>
            <link rel="stylesheet" href="53/SignUp_LogIn_Form.css">
            <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        </head>
        <body>
            <div class="container">
                <div class="form-box login">
                    <form action="{{ route('authenticate') }}" method="POST">
                        @csrf
                        <h1>Login</h1>
                        <div class="input-box">
                            <input type="text" placeholder="Username" value="{{ old('username') }}" name="username">
                            <i class='bx bxs-user'></i>
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-box">
                            <input type="password" placeholder="Password" name="password">
                            <i class='bx bxs-lock-alt' ></i>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                
                            @enderror
                        </div>
                        <div class="forgot-link">
                            <a href="#">Forgot Password?</a>
                        </div>
                        <button type="submit" class="btn">Login</button>
                    </form>
                </div>

                <div class="form-box register">
                    <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h1>Registration</h1>
                        <div class="input-box">
                            <input type="text" placeholder="Name" value="{{ old('name') }}" name="name" required>
                            <i class='bx bxs-id-card'></i>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-box">
                            <input type="text" placeholder="Username" value="{{ old('username') }}" name="username" required>
                            <i class='bx bxs-user'></i>
                            @error('username')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-box">
                            <input type="email" placeholder="Email" value="{{ old('email') }}" name="email" required>
                            <i class='bx bxs-envelope' ></i>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-box">
                            <input type="number" placeholder="Whatsapp Number" value="{{ old('whatsapp') }}" name="whatsapp" required>
                            <i class='bx bxs-envelope'></i>
                            @error('whatsapp')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-box">
                            <input type="file" name="file_path" required>
                            @error('file_path')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror       <i class='bx bxs-file'></i>
                        </div>
                    
                        <button type="submit" class="btn">Register</button>
                    </form>
                </div>

                <div class="toggle-box">
                    <div class="toggle-panel toggle-left">
                        <h1>Hello, Welcome!</h1>
                        <p>Don't have an account?</p>
                        <button class="btn register-btn">Register</button>
                    </div>

                    <div class="toggle-panel toggle-right">
                        <h1>Welcome Back!</h1>
                        <p>Already have an account?</p>
                        <button class="btn login-btn">Login</button>
                    </div>
                </div>
            </div>

            <script src="53/SignUp_LogIn_Form.js"></script>
            <script src="sweetalert2/dist/sweetalert2.all.min.js"></script>
                    @session('success')
                    <script>
                            Swal.fire({
                            title: "Good job!",
                            text: "{{ session('success') }}",
                            icon: "success"
                            });
                        </script>
                    @endsession
                    @session('error')
                        <script>
                            Swal.fire({
                            title: "Oops!",
                            text: "{{ session('error') }}",
                            icon: "error"
                            });
                        </script>
                    @endsession
        </body>
        </html>