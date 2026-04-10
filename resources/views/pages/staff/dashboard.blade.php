@extends('layout.app')

@section('content')
<style>
.dashboard-container {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    background-color: #f3f4f6;
    padding: 3rem 2rem;
    font-family: 'Inter', sans-serif;
}

.welcome {
    text-align: left;
    font-size: 1.125rem;
    font-weight: 600;
    color: #4b5563; 
    margin-top: 2rem;
    margin-bottom: 1.5rem;
}

.footer {
    text-align: center;
    padding: 1.5rem 0;
    color: #6b7280;
    background-color: #e5e7eb;
    border-top: 1px solid #d1d5db;
    font-size: 0.875rem;
}
</style>

<div class="dashboard-container">
    <div class="welcome">Selamat datang staff</div>
</div>
@endsection