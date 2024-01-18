<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sip Calculator</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Your additional styles or other CDN links go here -->
<style>
    .header-color {
        background-color: #ff725e;
    }
    .footer-color {
        background-color: #ff725e;
    }
</style>
</head>
<body>
    <header class="header-color text-light py-2">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Logo on the left -->
                <div>
                    <img src="{{ asset('yourlogso.png') }}" alt="Sip Calculator" style="max-height: 50px;width:100%">
                </div>

                <!-- Contact and SIP menu on the right -->
                <div>
                    <a href="{{route('sip-calculator.index')}}" class="text-light mx-2">SIP</a>
                    <a href="#" class="text-light mx-2">Contact</a>
                </div>
            </div>
        </div>
    </header>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 align-self-center">
                <img src="{{ asset('images/calculator.svg') }}" alt="Calculator Image">
            </div>
            <form id="sipForm" class="col-md-6 bg-light p-4 rounded shadow">
                @csrf
                <h5 class="mb-3">SIP Amount needed to reach target</h5>
                <div class="mb-3">
                    <label for="target" class="form-label">Target Amount (Rs):</label>
                    <input type="text" id="target" name="target" required
                        class="form-control" onkeyup="this.value = this.value.replace(/[^0-9]/g, ''); calculateSip()">
                </div>
    
                <div class="mb-3">
                    <label for="existing_investment" class="form-label">Existing Investment (Rs):</label>
                    <input type="text" id="existing_investment" name="existing_investment" value="0"
                        class="form-control" onkeyup="this.value = this.value.replace(/[^0-9]/g, ''); calculateSip()">
                </div>
    
                <div class="mb-3">
                    <label for="years" class="form-label">Number of years to target:</label>
                    <input type="text" id="years" name="years" value="5" required
                        class="form-control" onkeyup="this.value = this.value.replace(/[^0-9]/g, ''); calculateSip()">
                </div>
    
                <div class="mb-3">
                    <label for="returns" class="form-label">Expected returns from investments:</label>
                    <input type="text" id="returns" name="returns" value="12" required
                        class="form-control" onkeyup="this.value = this.value.replace(/[^0-9]/g, ''); calculateSip()">
                </div>
                <div id="result" class="mt-4 p-4 bg-light">
                    <h4 class="text-2xl font-semibold mb-4">Result</h4>
                    <p>Future value of existing investments: <span id="amtInvested" class="d-inline-block text-break">0</span></p>
                    <p>Monthly investment needed (Rs): <span id="formattedMonthlyInvestment" class="d-inline-block text-break">0</span></p>
                </div>
            </form>
            
        </div>
    </div>
    <footer class="header-color text-light py-3 mt-3">
        <div class="container text-center">
            <p>&copy; 2023 Sip Calculator. All rights reserved.</p>
        </div>
    </footer>
    <!-- Bootstrap JS CDN -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function calculateSip() {
            // Fetch form values
            var target = parseFloat(document.getElementById('target').value);
            var existingInvestment = parseFloat(document.getElementById('existing_investment').value) || 0;
            var years = parseFloat(document.getElementById('years').value);
            var returns = parseFloat(document.getElementById('returns').value);

            // Perform calculations
            var amtInvested = Math.round(existingInvestment * Math.pow(1 + (returns / 100), years));
            var monthlyInvestment = Math.round(((Math.round((target - amtInvested) * Math.pow(1 + (0 / 100), years))) * (returns / (100 * 12))) / (Math.pow(1 + ((returns / (100 * 12))), (years * 12)) - 1));

            // Display results
            document.getElementById('amtInvested').innerText = amtInvested;
            document.getElementById('formattedMonthlyInvestment').innerText = new Intl.NumberFormat('en-IN').format(monthlyInvestment);

            // Show result section
            document.getElementById('result').style.display = 'block';
        }
    </script>
</body>
</html>