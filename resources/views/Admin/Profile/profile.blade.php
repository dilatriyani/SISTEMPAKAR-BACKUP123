@extends('Admin.Partials.index')
@section('container')
    <main id="main" class="main">
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @if ($user->photo)
                                <img src="{{ asset('storage/photos/' . $user->photo) }}" alt=""
                                    style="width: 130px; height:130px" class="img-thumbnail rounded-circle mx-auto d-block">
                            @else
                                <img src="/../../assets/admin/images/profile.png" alt=""
                                    style="width: 130px; height:130px" class="img-thumbnail rounded-circle mx-auto d-block">
                            @endif
                            <div class="person-name">
                                <h2 class="text-center fs-4 my-2">{{ Auth::user()->name }}</h2>
                            </div>
                            <div class="person-email">
                                <h3 class="text-center fs-5 fw-normal mb-3">{{ Auth::user()->email }}</h3>
                            </div>
                            
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profile</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Change Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <h5 class="card-title">About</h5>
                                    <p class="small fst-italic">Sunt est soluta temporibus accusantium neque nam maiores
                                        cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure
                                        rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at
                                        unde.</p>

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Name</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->name }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Level</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->role }}</div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">email</div>
                                        <div class="col-lg-9 col-md-8">{{ Auth::user()->email }}</div>
                                    </div>

                                    <div class="password-container">
                                        <div class="col-md-4">
                                            <label for="password" class="form-label">Password</label>
                                        <input type="password" id="password-input" placeholder="Password" value="{{ Auth::user()->password }}" required>
                                        <span class="password-toggle" id="password-toggle" onclick="togglePasswordVisibility()" ></span>
                                    </div>

                                </div>

                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <!-- Change Password Form -->
                                    <form>

                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" type="password" class="form-control"
                                                    id="currentPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="newpassword" type="password" class="form-control"
                                                    id="newPassword">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter
                                                New Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="renewpassword" type="password" class="form-control"
                                                    id="renewPassword">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form><!-- End Change Password Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

        <script>
            function togglePasswordVisibility() {
                var passwordInput = document.getElementById("password-input");
                var passwordToggle = document.getElementById("password-toggle");
    
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                    passwordToggle.innerHTML = "&#128064;"; // Ubah ikon mata ke ikon silang saat password terlihat
                } else {
                    passwordInput.type = "password";
                    passwordToggle.innerHTML = "&#128065;"; // Ubah ikon silang ke ikon mata saat password disembunyikan
                }
            }
        </script>
    </main>
@endsection
