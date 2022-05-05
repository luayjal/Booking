<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\VerificationMail;
use Illuminate\Validation\Rule;
use App\Models\VerificationCode;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function register(AuthRequest $request)
    {


        if ($request->type == 'customer') {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'type' => $request->type,
                'password' => Hash::make($request->password),
            ]);
        } elseif ($request->type == 'shop') {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'type' => $request->type,
                'password' => Hash::make($request->password),
                'category_id' =>  $request->category_id,
                'lng' =>  $request->lng,
                'lat' =>  $request->lat,
            ]);

            $data = $request->all();
            if ($request->hasFile('logo')) {
                $file = $request->image;
                $data['logo'] = $file->move('uploads\images', 'img_' . uniqid() . '.' .  $file->getClientOriginalExtension());
            }
            // store category and lcation
            $user->shop()->create([
                'category_id' => $data['category_id'],
                'lat' => $data['lat'],
                'lng' => $data['lng'],
                'location' =>  $data['location'],
                'logo' => $data['logo'] ?? '',
            ]);

            // store work time
            for ($i = 0; $i < count($data['days']); $i++) {
                $user->workTimes()->create([
                    'days' => $data['days'][$i],
                    'status' => $data['status'][$i] ?? 'off',
                    'from' => $data['from'][$i],
                    'to' => $data['to'][$i]
                ]);
            }
        }
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'registered successfully',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }
    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'message' => 'login successfully',
            'user' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }

    public function forget_password(Request $request)
    {
        $user = User::where('email', $request->email)->firstOrFail();
        $code = rand(100000, 999999);
        VerificationCode::create([
            'user_id' => $user->id,
            'code' => $code,
            'expired_at' => now()->addMinutes(11),
        ]);

        Mail::to($user->email)->send(new VerificationMail($code, $user));

        return response()->json([
            'status' => true,
            'message' => 'we are send mail to your email',
            'user_id' =>  $user->id
        ]);
    }

    public function verificationCode(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'user_id' => 'required',
        ]);
        $user = User::findOrFail($request->user_id);

        $verification_code = VerificationCode::where([
            'code' => $request->code,
            'user_id' => $user->id,
        ])->first();

        if ($verification_code && $verification_code->expired_at > now()) {
            return response()->json([
                'status' => true,
                'message' => "success verification",
                'user_id' =>  $user->id,
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => "failed  verification"
            ]);
        }
    }

    public function newPassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = User::findOrFail($request->user_id);
        $user->password = Hash::make($request->password);
        $user->update();

        return response()->json([
            'status' => true,
            'message' => "success update",

        ]);
    }
}
