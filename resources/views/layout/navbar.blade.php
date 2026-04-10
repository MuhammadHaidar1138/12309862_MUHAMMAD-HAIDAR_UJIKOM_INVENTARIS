<style>
    .top-navbar {
        position: fixed;
        top: 20px;
        left: 270px;
        right: 20px;
        height: 60px;
        background-color: #ffffff;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 0 1rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .top-navbar button {
        background-color: #ef4444;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
    }

    .top-navbar button:hover {
        background-color: #dc2626;
    }

    .content-offset {
        margin-top: 100px;
    }
</style>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="top-navbar">Logout</button>
</form>