@extends('layouts.admin')

@section('title', 'Root Master Control – Infinity Interns')

@section('content')
<div class="space-y-6">
    <div class="p-6 md:p-8 rounded-2xl bg-gradient-to-r from-amber-950/40 via-slate-900 to-slate-900 border border-amber-500/20">
        <div class="flex items-center gap-2 px-3 py-1 rounded-full bg-amber-500/10 text-amber-300 text-xs font-semibold w-fit mb-3 border border-amber-500/20">
            <span>👑 Root Master Control</span>
        </div>
        <h2 class="text-2xl font-bold text-white mb-2">Super Admin Control Center</h2>
        <p class="text-slate-300 text-xs sm:text-sm max-w-2xl leading-relaxed">
            Multi-tenant institute configuration, global database performance metrics, partner college verification, audit logs, and master curriculum controls for Infinity Interns.
        </p>
    </div>

    <!-- System Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="p-5 rounded-2xl bg-slate-900/70 border border-slate-800">
            <span class="text-xs text-slate-400 font-medium block mb-1">Partner Colleges</span>
            <div class="text-2xl font-bold text-white">{{ $stats['partner_colleges'] }}</div>
            <span class="text-[11px] text-emerald-400">Bihar, UP & Jharkhand</span>
        </div>
        <div class="p-5 rounded-2xl bg-slate-900/70 border border-slate-800">
            <span class="text-xs text-slate-400 font-medium block mb-1">Total Student Accounts</span>
            <div class="text-2xl font-bold text-white">{{ $stats['students'] }}</div>
            <span class="text-[11px] text-indigo-400">Undergraduate Cohorts</span>
        </div>
        <div class="p-5 rounded-2xl bg-slate-900/70 border border-slate-800">
            <span class="text-xs text-slate-400 font-medium block mb-1">Database Engine</span>
            <div class="text-xl font-bold text-white uppercase">{{ $stats['db_connection'] }}</div>
            <span class="text-[11px] text-slate-400">{{ $stats['db_version'] }}</span>
        </div>
        <div class="p-5 rounded-2xl bg-slate-900/70 border border-slate-800">
            <span class="text-xs text-slate-400 font-medium block mb-1">Runtime Environment</span>
            <div class="text-xl font-bold text-emerald-400">PHP {{ $stats['php_version'] }}</div>
            <span class="text-[11px] text-slate-400">Laravel v{{ $stats['laravel_version'] }}</span>
        </div>
    </div>

    <!-- Partner Colleges Roster -->
    <div class="p-6 rounded-2xl bg-slate-900/70 border border-slate-800 space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-800">
            <h3 class="text-base font-semibold text-white">Associated Partner Colleges & Universities</h3>
            <span class="text-xs text-slate-400">Active MOUs</span>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($colleges as $c)
            <div class="p-4 rounded-xl bg-slate-800/40 border border-slate-800 space-y-1">
                <span class="text-[10px] font-bold text-emerald-400 uppercase tracking-wider block">{{ $c['status'] }}</span>
                <h4 class="text-xs font-bold text-white leading-snug">{{ $c['name'] }}</h4>
                <p class="text-[11px] text-slate-400">{{ $c['region'] }}</p>
                <div class="pt-2 flex items-center justify-between text-[11px] text-slate-300">
                    <span>Enrolled Cohort:</span>
                    <span class="font-bold text-indigo-400">{{ $c['students'] }} Interns</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
