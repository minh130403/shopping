<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title("Đăng nhập")]
class Login extends Component
{
    #[Rule("required", message:"Vui lòng nhập email đã đăng ký")]
    public $email;

    #[Rule("required", message:"Vui lòng nhập mật khẩu")]
    public $password;

    public function mount(){
        $this->email = 'admin@gmail.com';
        $this->password = 'admin';

        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // điều kiện tìm
            [
                'name' => 'Minh',
                'password' => Hash::make('admin')
            ] // dữ liệu tạo hoặc cập nhật
        );
    }

    public function authenticate(){
       $this->validate();

        $credentials = [
            'email' => $this->email,
            'password' => $this->password
        ];

        if (Auth::attempt($credentials)) {
            Session::regenerate();

            return redirect("/admin/dashbroad");
        }

        $this->addError('email', 'Thông tin đăng nhập không đúng.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
