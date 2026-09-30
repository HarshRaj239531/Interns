@extends('layouts.app')

@section('title', 'Portal Access Login – Infinity Interns')

@section('content')
<section class="min-h-[80vh] flex items-center justify-center py-16 px-4 bg-[#F6F8F5]">
    <div class="w-full max-w-md bg-white rounded-[2.5rem] border border-slate-200/90 p-8 sm:p-10 shadow-xl">
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-indigo-50 border border-indigo-100 text-indigo-700 text-2xl mb-4 font-bold shadow-xs">
                ∞
            </div>
            <h2 class="text-2xl font-serif font-bold text-slate-900">Portal Login</h2>
            <p class="text-xs text-slate-500 mt-1">Sign in to your Student, Admin, or Institutional Workspace</p>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Email Address</label>
                <input type="email" id="loginEmail" name="email" value="{{ old('email') }}" required placeholder="your.email@example.com" class="w-full px-4 py-3 rounded-xl bg-[#FAFBF9] border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Password</label>
                <input type="password" id="loginPassword" name="password" required placeholder="••••••••" class="w-full px-4 py-3 rounded-xl bg-[#FAFBF9] border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <div class="flex items-center justify-between text-xs text-slate-600">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500">
                    <span>Remember me</span>
                </label>
                <span class="text-slate-400">Secure Access</span>
            </div>

            <button type="submit" class="w-full py-3.5 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-indigo-600/25 cursor-pointer active:scale-95">
                Sign In to Portal
            </button>
        </form>

        <!-- Quick Demo Account Fillers -->
        <div class="mt-8 pt-6 border-t border-slate-100 text-center">
            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block mb-3">Quick Demo One-Click Fill</span>
            <div class="flex flex-col gap-2 text-xs">
                <button type="button" onclick="fillCreds('admin@infinityinterns.com', 'Admin@123')" class="w-full py-2 px-3 rounded-xl bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-semibold border border-indigo-100 transition cursor-pointer text-left flex items-center justify-between">
                    <span>🛡️ Fill Admin Portal</span>
                    <span class="text-[10px] font-mono text-indigo-500">admin@infinityinterns.com</span>
                </button>
                <button type="button" onclick="fillCreds('superadmin@infinityinterns.com', 'SuperAdmin@123')" class="w-full py-2 px-3 rounded-xl bg-amber-50 hover:bg-amber-100 text-amber-800 font-semibold border border-amber-200 transition cursor-pointer text-left flex items-center justify-between">
                    <span>👑 Fill Super Admin</span>
                    <span class="text-[10px] font-mono text-amber-600">superadmin@infinityinterns.com</span>
                </button>
                <button type="button" onclick="fillCreds('aditya.raj@example.com', 'Student@123')" class="w-full py-2 px-3 rounded-xl bg-emerald-50 hover:bg-emerald-100 text-emerald-800 font-semibold border border-emerald-200 transition cursor-pointer text-left flex items-center justify-between">
                    <span>🎓 Fill Student Portal (Aditya)</span>
                    <span class="text-[10px] font-mono text-emerald-600">aditya.raj@example.com</span>
                </button>
            </div>
        </div>

        <div class="mt-6 text-center text-xs text-slate-500">
            <span>New Student? </span>
            <button onclick="openApplyModal()" class="font-bold text-indigo-600 hover:underline cursor-pointer">
                Register & Apply Here
            </button>
        </div>
    </div>
</section>

@section('scripts')
<script>
    function fillCreds(email, password) {
        document.getElementById('loginEmail').value = email;
        document.getElementById('loginPassword').value = password;
    }
</script>
@endsection
@endsection
