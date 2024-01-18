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
                <h5 class="mb-3">SIP Value Calculator</h5>
                <div class="mb-3">
                    <label for="monthly" class="form-label">My monthly investment (Rs):</label>
                    <input type="text" id="monthly" name="monthly" required class="form-control" onkeyup="calculateSIP()">
                </div>
        
                <div class="mb-3">
                    <label for="months" class="form-label">Number of years I plan to invest:</label>
                    <input type="text" id="months" name="months" required class="form-control" onkeyup="calculateSIP()">
                </div>
        
                <div class="mb-3">
                    <label for="returns" class="form-label">Expected returns (Annual, CAGR):</label>
                    <select id="returns" name="returns" class="form-control" onchange="calculateSIP()">
                        <option value="7">7%</option>
                        <option value="7.5">7.5%</option>
                        <option value="8">8%</option>
                        <option value="8.5">8.5%</option>
                        <option value="9">9%</option>
                        <option value="9.5">9.5%</option>
                        <option value="10">10%</option>
                        <option value="10.5">10.5%</option>
                        <option value="11">11%</option>
                        <option value="11.5">11.5%</option>
                        <option value="12" selected>12%</option>
                        <option value="12.5">12.5%</option>
                        <option value="13">13%</option>
                        <option value="13.5">13.5%</option>
                        <option value="14">14%</option>
                        <option value="14.5">14.5%</option>
                        <option value="15">15%</option>
                        <option value="16">16%</option>
                        <option value="17">17%</option>
                        <option value="18">18%</option>
                        <option value="19">19%</option>
                        <option value="20">20%</option>
                    </select>
                </div>
        
                <div class="mb-3">
                    <label for="field_c67ce2a" class="form-label">Value of SIP at the end of period (Rs):</label>
                    <input type="text" id="field_c67ce2a" name="field_c67ce2a" readonly class="form-control">
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
        // Function to calculate SWP
        function calculateSIP() {
            let monthly = parseFloat(document.getElementById('monthly').value);
            let months = parseInt(document.getElementById('months').value);
            let returns = parseFloat(document.getElementById('returns').value);

            if (isNaN(monthly) || isNaN(months) || isNaN(returns)) {
                document.getElementById('field_c67ce2a').value = 0;
                return;
            }

            let sipValue = Math.round(monthly * 12 * (Math.pow((1 + returns / 100), months) - 1) / (returns / 100) * (1 + returns / 100));

            let formatter = new Intl.NumberFormat('en-IN');
            document.getElementById('field_c67ce2a').value = formatter.format(sipValue);
        }

    </script>
</body>
</html>