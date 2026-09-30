@extends('layouts.app')

@section('title', 'Contact & Helpdesk – Infinity Interns')

@section('content')
<!-- Hero -->
<section class="relative min-h-[45vh] flex items-center justify-center pt-24 pb-16 overflow-hidden bg-[#0A1128] text-white">
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[500px] bg-indigo-500/15 rounded-full blur-[140px]"></div>
        <div class="absolute inset-0 bg-[radial-gradient(#ffffff_1px,transparent_1px)] [background-size:24px_24px] opacity-10"></div>
    </div>

    <div class="relative z-10 max-w-5xl mx-auto px-4 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-indigo-400/30 bg-indigo-500/10 backdrop-blur-md mb-6">
            <span class="text-indigo-400 text-xs">✦</span>
            <span class="text-[11px] font-bold tracking-[0.3em] uppercase text-indigo-300">Student & College Support Desk</span>
        </div>
        <h1 class="text-4xl sm:text-6xl md:text-7xl font-serif text-white leading-tight mb-6">
            Connect with <br>
            <span class="text-indigo-400 italic">Infinity Interns.</span>
        </h1>
        <p class="max-w-2xl mx-auto text-base sm:text-lg text-indigo-100/80 font-light leading-relaxed">
            Whether you have queries regarding course registration, semester credit alignment, or institutional college partnerships, our team is here to assist you.
        </p>
    </div>
</section>

<!-- Contact Info & Form -->
<section class="py-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        <!-- Direct Contacts -->
        <div class="lg:col-span-5 space-y-6">
            <span class="text-indigo-600 font-bold text-xs tracking-[0.3em] uppercase block">Contact Information</span>
            <h2 class="text-3xl sm:text-4xl font-serif text-slate-900 leading-tight">
                We're Here to Walk the <br>
                <span class="text-indigo-700 italic">Path with You.</span>
            </h2>
            <p class="text-sm text-slate-600 font-light leading-relaxed">
                Reach out directly to our student advisors via telephone, email, or WhatsApp. We respond promptly during official office hours.
            </p>

            <div class="space-y-4 pt-2">
                <a href="mailto:info@infinityinterns.com" class="p-5 rounded-2xl bg-white border border-slate-200/80 hover:border-slate-300 hover:shadow-md transition flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-700 flex items-center justify-center shrink-0 border border-indigo-100 text-xl">✉️</div>
                    <div class="overflow-hidden">
                        <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-bold">Official Student Email</span>
                        <span class="text-sm font-bold text-slate-900 truncate block">info@infinityinterns.com</span>
                    </div>
                </a>

                <a href="tel:+916204141971" class="p-5 rounded-2xl bg-white border border-slate-200/80 hover:border-slate-300 hover:shadow-md transition flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 border border-emerald-100 text-xl">📞</div>
                    <div class="overflow-hidden">
                        <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-bold">Helpline & WhatsApp</span>
                        <span class="text-sm font-bold text-slate-900 truncate block">+91 6204141971</span>
                    </div>
                </a>

                <a href="tel:+916204221832" class="p-5 rounded-2xl bg-white border border-slate-200/80 hover:border-slate-300 hover:shadow-md transition flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-700 flex items-center justify-center shrink-0 border border-emerald-100 text-xl">📞</div>
                    <div class="overflow-hidden">
                        <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-bold">Alternate Line</span>
                        <span class="text-sm font-bold text-slate-900 truncate block">+91 6204221832</span>
                    </div>
                </a>

                <div class="p-5 rounded-2xl bg-white border border-slate-200/80 flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center shrink-0 border border-rose-100 text-xl">📍</div>
                    <div class="overflow-hidden">
                        <span class="text-[10px] text-slate-400 uppercase tracking-wider block font-bold">Operational Center</span>
                        <span class="text-sm font-bold text-slate-900 truncate block">Patna, Bihar, India</span>
                    </div>
                </div>
            </div>

            <div class="p-6 rounded-2xl bg-indigo-50 border border-indigo-100 text-xs text-indigo-900 font-medium">
                ⏱️ Office Hours: Monday – Saturday, 9:30 AM to 6:30 PM IST
            </div>
        </div>

        <!-- Working Form -->
        <div class="lg:col-span-7 bg-white p-8 sm:p-12 rounded-[2.5rem] border border-slate-200/90 shadow-xl">
            <h3 class="text-2xl font-serif text-slate-900 mb-1 font-bold">Send Us a Direct Message</h3>
            <p class="text-xs text-slate-500 mb-6 font-light">Fill in your details below and our counseling desk will get in touch with you.</p>

            <form action="{{ route('inquiry.contact') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Your Full Name *</label>
                        <input required type="text" name="name" placeholder="e.g. Rahul Sharma" class="w-full px-4 py-2.5 rounded-xl bg-[#FAFBF9] border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">WhatsApp / Phone *</label>
                        <input required type="tel" name="phone" placeholder="+91 9876543210" class="w-full px-4 py-2.5 rounded-xl bg-[#FAFBF9] border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Email Address *</label>
                        <input required type="email" name="email" placeholder="rahul@example.com" class="w-full px-4 py-2.5 rounded-xl bg-[#FAFBF9] border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Undergraduate Degree</label>
                        <select name="degree" class="w-full px-4 py-2.5 rounded-xl bg-[#FAFBF9] border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="BA">Bachelor of Arts (BA)</option>
                            <option value="BSc">Bachelor of Science (BSc)</option>
                            <option value="BBA">Bachelor of Business Admin (BBA)</option>
                            <option value="BCA">Bachelor of Computer App (BCA)</option>
                            <option value="BCom">Bachelor of Commerce (BCom)</option>
                            <option value="Other">Other Degree</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">College / University Name</label>
                    <input type="text" name="college" placeholder="e.g. Patna Science College" class="w-full px-4 py-2.5 rounded-xl bg-[#FAFBF9] border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Your Question / Message *</label>
                    <textarea required name="message" rows="4" placeholder="Describe what you would like to know regarding our internship programs, fees, certificate verification, or dates..." class="w-full px-4 py-2.5 rounded-xl bg-[#FAFBF9] border border-slate-200 text-xs text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500"></textarea>
                </div>

                <button type="submit" class="w-full h-13 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-indigo-600/25 flex items-center justify-center gap-2 cursor-pointer active:scale-95">
                    <span>Submit Message</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
            </form>
        </div>
    </div>
</section>
@endsection
