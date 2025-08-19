<div class="welcome-header">
    <h1 class="greeting">
        Welcome
    </h1>
    <div class="action-buttons">
        <a href="{{ route('userlogout') }}" class="logout-btn">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form action="payment" method="post" class="payment-form">
            @csrf
            <button type="submit" class="pay-btn">Pay</button>
        </form>
    </div>
</div>

<style>
.welcome-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.greeting {
    font-size: 2rem;
    color: #2c3e50;
    margin: 0;
}

.action-buttons {
    display: flex;
    gap: 15px;
    align-items: center;
}

.logout-btn {
    display: inline-flex;
    align-items: center;
    padding: 8px 16px;
    background-color: #dc3545;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.logout-btn:hover {
    background-color: #c82333;
    color: white;
}

.logout-btn i {
    margin-right: 8px;
}

.payment-form {
    margin: 0;
}

.pay-btn {
    padding: 8px 16px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.pay-btn:hover {
    background-color: #0056b3;
}
</style>
