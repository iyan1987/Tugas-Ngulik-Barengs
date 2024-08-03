<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>    
<body>

    <div class="container">
        <h1>Edit User</h1>
        <a href="{{ route('user') }}">Kembali</a>

        <hr>

        <div class="row">
            <div class="col-lg-6">


                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Full Name</label>
                        <div class="col-sm-9">
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">

                            @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" name="email" class="form-control" value="{{ old('email',$user->email) }}">

                            @error('email')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="password" class="form-control">
                            <small>Kosongkan jika tidak ingin diganti</small>
                            @error('password')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror

                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                            <input type="password" name="password_confirmation" class="form-control">
                            <small>Kosongkan jika tidak ingin diganti</small>

                            @error('password_confirm')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Photo</label>
                        <div class="col-sm-9">
                            <input type="file" name="photo" class="form-control">
                            <small>Kosongkan jika tidak ingin diganti</small>

                            @error('photo')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label class="col-sm-3 col-form-label">Job</label>
                        <div class="col-sm-9">
                            <select name="job" class="form-control">
                                <option value="">-Select-</option>
                                <option <?php if(old('job', $user->job) == "Programmer"){ echo "selected='selected'";} ?> value="Programmer">Programmer</option>
                                <option <?php if(old('job', $user->job) == "Teacher"){ echo "selected='selected'";} ?> value="Teacher">Teacher</option>
                            </select>

                            @error('job')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    

                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-3 pt-0">Gender</legend>
                        <div class="col-sm-9">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" <?php if(old('gender', $user->gender) == "Male"){ echo "checked"; } ?> value="Male">
                                <label class="form-check-label">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="gender" <?php if(old('gender', $user->gender) == "Female"){ echo "checked"; } ?> value="Female">
                                <label class="form-check-label">
                                    Female
                                </label>
                            </div>

                            @error('gender')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </fieldset>

                    <?php 
                    $arr = explode(",", $user->hobbies);
                    ?>
                    <fieldset class="row mb-3">
                        <legend class="col-form-label col-sm-3 pt-0">Hobbies</legend>
                        <div class="col-sm-9">
                         <div class="form-check">
                            <input class="form-check-input" name="hobbies[]" value="Coding" type="checkbox" id="gridCheck1" <?php if(in_array("Coding", $arr)){ echo "checked";} ?>>
                            <label class="form-check-label" for="gridCheck1">
                                Coding
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="hobbies[]" value="Ngoprek Infra" type="checkbox" id="gridCheck1" <?php if(in_array("Ngoprek Infra", $arr)){ echo "checked";} ?>>
                            <label class="form-check-label" for="gridCheck1">
                                Ngoprek Infra
                            </label>
                        </div>

                        @error('hobbies')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                        @enderror

                    </div>
                </fieldset>

                <button type="submit" class="btn btn-primary offset-lg-3">Submit</button>
            </form>

        </div>
    </div>

</div>



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</html>
