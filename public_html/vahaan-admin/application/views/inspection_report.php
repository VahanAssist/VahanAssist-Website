<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Car Inspection Report</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f9f9f9;
    }
    .section-title {
      background-color: #f1f9ff;
      padding: 20px;
      border-left: 5px solid #007bff;
      margin-bottom: 20px;
      font-weight: 600;
    }
    .check-icon {
      color: green;
      font-weight: bold;
    }
    .img-thumbnail {
      border: none;
      border-radius: 12px;
      object-fit: cover;
      height: 160px;
    }
    .info-card {
      border: 1px solid #ddd;
      border-radius: 12px;
      padding: 20px;
      background: #fff;
    }
    .rating-box {
      background: #fff3cd;
      border-radius: 8px;
      padding: 10px 15px;
      font-weight: bold;
      color: #856404;
      display: inline-block;
    }
    .summary {
      background-color: #fff;
      padding: 20px;
      border-radius: 12px;
      margin-bottom: 20px;
    }
    .vehicle-images-title {
      font-weight: 600;
      font-size: 1.5rem;
      margin: 40px 0 20px;
    }
  </style>
</head>
<body>

<div class="container py-5">

  <!-- Section 1: Vehicle Overview -->
  <div class="row mb-4">
    <div class="col-md-4">
      <img src="front.jpg" alt="Car Front" class="img-fluid rounded">
    </div>
    <div class="col-md-8">
      <div class="info-card h-100 d-flex flex-column justify-content-between">
        <div>
          <h4>BMW X1</h4>
          <p class="text-muted">SDRIVE 20D | 2012 | Automatic | Diesel</p>
          <div class="rating-box">Overall Rating: 3.8/5 - Neutral</div>
          <p class="mt-3 mb-1"><strong>Odometer:</strong> XXXX km</p>
          <p class="text-success mb-0"><i class="bi bi-check-circle-fill"></i> No Challan on this vehicle</p>
        </div>
        <div class="d-flex justify-content-between mt-4">
          <div><strong>Ownership no.</strong><br>03</div>
          <div><strong>Blacklisted</strong><br>No</div>
          <div><strong>Hypothecation</strong><br>Yes</div>
        </div>
      </div>
    </div>
  </div>

  <!-- Section 2: Health Report Summary -->
  <div class="summary shadow-sm">
    <h5><i class="bi bi-heart-pulse-fill me-2"></i>Health Report Summary</h5>
    <ul>
      <li>The car's engine has a major sound issue.</li>
      <li>The car's suspension has an abnormal noise.</li>
      <li>The car's ORVM has a folding motor not working and the switch is broken.</li>
    </ul>
    <p>The car has some issues with the engine, suspension, and ORVM, but the overall condition is fair.</p>
  </div>

  <!-- Section 3: Ownership and Validity Details -->
  <div class="summary shadow-sm">
    <h5><i class="bi bi-card-checklist me-2"></i>Ownership and Validity Details</h5>
    <div class="row">
      <div class="col-md-6">
        <p><strong>Owner:</strong> [Name Hidden]</p>
        <p><strong>Ownership number:</strong> 3</p>
        <p><strong>Ownership type:</strong> Individual</p>
        <p><strong>Estimated kms/year:</strong> XXXX km</p>
      </div>
      <div class="col-md-6">
        <p><strong>Registration date:</strong> XX Jan 20XX</p>
        <p><strong>Registration place:</strong> [City Hidden]</p>
        <p><strong>Fitness validity:</strong> XX Jan 20XX</p>
        <p><strong>PUCC validity:</strong> 10 May, 2024</p>
      </div>
    </div>
  </div>

  <!-- Section 4: Exterior & Tyres -->
  <div class="section-title">01. Exterior & Tyres — Perfect: 27 | Imperfect: 24</div>
  <table class="table table-bordered bg-white shadow-sm">
    <thead class="table-light">
      <tr>
        <th>Parameters</th>
        <th class="text-center">Perfect</th>
        <th class="text-center">Imperfect</th>
      </tr>
    </thead>
    <tbody>
      <tr><td>Boot Floor</td><td class="text-center check-icon">✔</td><td></td></tr>
      <tr><td>Pillar RHS B</td><td class="text-center check-icon">✔</td><td></td></tr>
      <tr><td>Pillar RHS A</td><td class="text-center check-icon">✔</td><td></td></tr>
      <tr><td>Pillar RHS C</td><td class="text-center check-icon">✔</td><td></td></tr>
      <tr><td>Pillar LHS C</td><td class="text-center check-icon">✔</td><td></td></tr>
      <tr><td>Apron LHS</td><td class="text-center check-icon">✔</td><td></td></tr>
      <tr><td>Apron RHS</td><td class="text-center check-icon">✔</td><td></td></tr>
      <tr><td>Apron RHS LEG</td><td class="text-center check-icon">✔</td><td></td></tr>
      <tr><td>Apron LHS LEG</td><td class="text-center check-icon">✔</td><td></td></tr>
      <tr><td>Firewall</td><td class="text-center check-icon">✔</td><td></td></tr>
      <tr><td>Cowl Top</td><td class="text-center check-icon">✔</td><td></td></tr>
      <tr><td>Upper Cross Member (Bonnet Patti)</td><td class="text-center check-icon">✔</td><td></td></tr>
      <tr><td>Front Show</td><td class="text-center check-icon">✔</td><td></td></tr>
      <tr><td>Lower Cross Member</td><td class="text-center check-icon">✔</td><td></td></tr>
      <tr><td>Radiator Support</td><td class="text-center check-icon">✔</td><td></td></tr>
      <tr><td>Head Light Support</td><td class="text-center check-icon">✔</td><td></td></tr>
      <tr><td>Windshield Rear</td><td class="text-center check-icon">✔</td><td></td></tr>
    </tbody>
  </table>

  <!-- Section 5: Vehicle Images -->
  <div class="vehicle-images-title d-flex align-items-center">
    <span class="me-2"><i class="bi bi-eye"></i></span>Vehicle Images
  </div>
  <div class="row g-3">
    <!-- Replace src with actual image paths -->
    <div class="col-6 col-md-4"><img src="front.jpg" alt="Front" class="img-thumbnail w-100"></div>
    <div class="col-6 col-md-4"><img src="rear.jpg" alt="Rear" class="img-thumbnail w-100"></div>
    <div class="col-6 col-md-4"><img src="left.jpg" alt="Left Side" class="img-thumbnail w-100"></div>
    <div class="col-6 col-md-4"><img src="interior.jpg" alt="Interior" class="img-thumbnail w-100"></div>
    <div class="col-6 col-md-4"><img src="engine.jpg" alt="Engine" class="img-thumbnail w-100"></div>
    <div class="col-6 col-md-4"><img src="boot.jpg" alt="Boot" class="img-thumbnail w-100"></div>
    <div class="col-6 col-md-4"><img src="dashboard.jpg" alt="Dashboard" class="img-thumbnail w-100"></div>
    <div class="col-6 col-md-4"><img src="speedometer.jpg" alt="Speedometer" class="img-thumbnail w-100"></div>
  </div>

</div>

</body>
</html>
