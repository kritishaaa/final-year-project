<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courier Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="{{ asset('assets/css/nav.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/welcome.css') }}" />
</head>

<body>
    <!-- Navigation -->
    <nav>
        <div class="logo">COURIER</div>

        <div class="nav-actions">
            <a href="{{ route('login') }}" class="login-btn">Login</a>
        </div>

    </nav>

    <!-- Hero Section -->
    <div class="hero">
        <h1 class="hero-title">Courier Management</h1>
        <p class="hero-slogan">Fast, Reliable, and Secure Delivery Solutions</p>

        <!-- Search Bar -->
      <div class="search-container">
  <input id="trackingInput" type="text" placeholder="Enter tracking number..." aria-label="Tracking number">
  <button id="trackBtn" class="search-btn" type="button">Track</button>
</div>

<script>
(function() {
  const input = document.getElementById('trackingInput');
  const btn = document.getElementById('trackBtn');

  function doTrack() {
    const code = (input?.value || '').trim();
    if (!code) {
      // You can replace alerts with nicer UI toasts
      alert('Please enter a tracking code.');
      input.focus();
      return;
    }

    // disable to avoid double-click
    btn.disabled = true;
    btn.textContent = 'Searching...';

    // encode to be safe for URLs
    const safe = encodeURIComponent(code);
    // redirect
    window.location.href = '/track/' + safe;
  }

  btn.addEventListener('click', doTrack);

  // submit on Enter key
  input.addEventListener('keydown', function(e) {
    if (e.key === 'Enter') {
      e.preventDefault();
      doTrack();
    }
  });
})();
</script>

        <!-- Feature Cards -->
        <div class="features">
            <div class="feature-card">
                <div class="feature-icon">📦</div>
                <h3>Real-Time Tracking</h3>
                <p>Track your parcels in real-time with live updates</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🚀</div>
                <h3>Fast Delivery</h3>
                <p>Express delivery options available nationwide</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">🔒</div>
                <h3>Secure Handling</h3>
                <p>Your packages are safe with our secure system</p>
            </div>
        </div>
    </div>
</body>

<script>
function trackParcel() {
    const code = document.getElementById('trackingInput').value.trim();
    if (code === "") {
        alert("Please enter tracking code.");
        return;
    }
    window.location.href = "/track/" + code; // redirect to tracking details
}
</script>


</html>
