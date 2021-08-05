@extends('layouts.user')

@section('content')
    <div class="wrap-breadcrumb">
        <ul>
            <li class="item-link"><a href="{{route('home')}}" class="link">home</a></li>
            <li class="item-link"><span>Profile</span></li>
        </ul>
    </div>
    
        <h3 class="box-title">Profile Data</h3>          
        <form action="{{route('update_profile')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 col-12">
                    <table style="width: 100%" class="profile-table">
                        <tr>
                            <td colspan="2">
                                <div class="profile-cont">
                                    <img src="{{$user->photo == 'user.jpg' ? asset('assets/img/user.png') : asset('files/user_images/'.$user->photo)}}" alt="photo.jpg" class="profile-pic" id="prof-pic" onclick="document.getElementById('input-pic').click()">
                                    <input type="file" style="display: none" id="input-pic" name="photo" accept="image/*">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Contact</td>
                            <td>
                                <input type="text" name="contact" value="{{ $user->contact }}" style="width: 100%; border:1px solid black;padding:2px">
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                                <textarea name="address" style="resize: none; width: 100%; border:1px solid black" cols="20" rows="10">{{ $user->address }}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right"><button class="btn btn-success">Save</button></td>
                        </tr>
                    </table>  
                </div>
            </div>
        </form>
        <h4>Change Password</h4>
        <form action="{{route('change_password')}}" method="post" id="change_form">
            @csrf
            <div class="row">
                <div class="col-md-6 col-12">
                    <table style="width: 100%" class="profile-table">
                        <tr>
                            <td>Old Password
                                @error('current_password')
                                    <span style="color:red;text-align:right">Current Password is Wrong</span>
                                @enderror
                            </td>
                            <td>
                                <input type="password" name="current_password" style="width: 100%; border:1px solid black;padding:2px" required>
                            </td>
                        </tr>
                        <tr>
                            <td>New Password
                                @error('new_password')
                                    <span style="color:red">{{$message}}</span>
                                @enderror
                            </td>
                            <td>
                                <input type="password" name="new_password"  style="width: 100%; border:1px solid black;padding:2px" required>
                            </td>
                        </tr>
                        <tr>
                            <td>Password Confirmation
                                @error('new_confirm_password')
                                    <span style="color:red">{{$message}}</span>
                                @enderror
                            </td>
                            <td>
                                <input type="password" name="new_confirm_password" style="width: 100%; border:1px solid black;padding:2px" required>
                            </td>
                        </tr>

                        <tr>
                            <td></td>
                            <td class="text-right"><button class="btn btn-primary">Change Password</button></td>
                        </tr>
                    </table>  
                </div>
            </div>
        </form>
                            

@endsection

@section('page-script')
    <script>
        imgInp = document.getElementById('input-pic');
        imgInp.onchange = evt => {
        const [file] = imgInp.files
            if (file) {
                document.getElementById('prof-pic').src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection