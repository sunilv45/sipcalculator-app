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
            <form id="swpCalculatorForm" class="col-md-6 bg-light p-4 rounded shadow">
                @csrf
                <h5 class="mb-3">SWP Calculator</h5>
            
                <div class="mb-3">
                    <label for="corpus" class="form-label">Corpus to be used for income generation (Rs):</label>
                    <input type="number" class="form-control" id="corpus" name="corpus" value="10000000" required onkeyup="calculateSWP()">
                </div>
            
                <div class="mb-3">
                    <label for="returns" class="form-label">Expected investment returns:</label>
                    <select class="form-control" id="returns" name="returns" required onkeyup="calculateSWP()">
                        <option value="7">7%</option>
                        <option value="7.5">7.5%</option>
                        <option value="8" selected>8%</option>
                        <option value="8.5">8.5%</option>
                        <option value="9">9%</option>
                        <option value="9.5">9.5%</option>
                        <option value="10">10%</option>
                        <option value="10.5">10.5%</option>
                        <option value="11">11%</option>
                        <option value="11.5">11.5%</option>
                        <option value="12">12%</option>
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
                    <label for="inflation" class="form-label">Expected inflation during the period of withdrawal:</label>
                    <select class="form-control" id="inflation" name="inflation" required onkeyup="calculateSWP()">
                        <option value="4">4%</option>
                        <option value="4.5">4.5%</option>
                        <option value="5">5%</option>
                        <option value="5.5">5.5%</option>
                        <option value="6" selected>6%</option>
                        <option value="6.5">6.5%</option>
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
                        <option value="12">12%</option>
                    </select>
                </div>
            
                <div class="mb-3">
                    <label for="monthly" class="form-label">Monthly withdrawal amount (Rs):</label>
                    <input type="number" class="form-control" id="monthly" name="monthly" value="50000" required onkeyup="calculateSWP()">
                </div>
            
                <div class="mb-3">
                    <label for="years" class="form-label">Number of years the investment corpus will last:</label>
                    <input type="text" class="form-control" id="years" name="years" readonly>
                </div>
            
                {{-- <button type="button" class="btn btn-primary" onclick="calculateSWP()">Calculate</button> --}}
            
                <!-- Additional Result Section -->
                <div id="result" class="mt-4 p-4 bg-light">
                    <h4 class="text-2xl font-semibold mb-4">Result</h4>
                    <!-- Add result elements here if needed -->
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
    // Function to calculate SWP
    function calculateSWP() {
        const form = document.getElementById('swpCalculatorForm');
        const corpus = parseFloat(form.corpus.value);
        //const returns = parseFloat(form.returns.value) / 100;
        const returns = parseFloat(form.returns.value);
        //const inflation = parseFloat(form.inflation.value) / 100;
        const inflation = parseFloat(form.inflation.value);
        const monthly = parseFloat(form.monthly.value);

        const years = findFinalYear(corpus, returns, inflation, monthly);

        form.years.value = years;

        // Additional logic to display results in the result section
        const resultSection = document.getElementById('result');
        resultSection.innerHTML = `<h4 class="text-2xl font-semibold mb-4">Result</h4>`;
        resultSection.innerHTML += `<p>Additional result elements can be added here. Updated on keyup event.</p>`;
    }

    // Function to calculate the final year
    function findFinalYear(corpus, returns, inflation, monthly) {
    const r = (returns / 100) / 12;
    const numMonths = Math.log((monthly * (Math.pow(1 + r, 12 * 100) - 1)) / (r * corpus - monthly * (1 + inflation / 100 / 12))) / Math.log(1 + r);

    // Convert months to years and round the result
    const numYears = Math.round(numMonths / 12);

    // Limit the result to 100+ if it exceeds 100
    return numYears >= 100 ? '100+' : numYears;
}


    // Call calculateSWP on page load
    window.onload = calculateSWP;
    </script>
</body>
</html>