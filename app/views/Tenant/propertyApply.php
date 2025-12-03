<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Apply Property</title>

  <style>

    *{box-sizing: border-box; font-family: sans-serif;}

    html,body{ height:100%; margin:0; background:#f5f7fb; color:#0f1724;}
    .page{max-width:720px; margin:28px auto; padding:20px;}
    .header{ display:flex; gap:12px; align-items:center;  margin-bottom:18px;}
    .head-text .title{font-size:18px;  font-weight:780;}
    .head-text .subtitle{ font-size:13px;  color:#555;}
    .property{ background:#ffffff;  border-radius:14px; padding:14px; box-shadow:0 10px 30px rgba(16,24,40,0.08);
    margin-bottom:18px;}
    .property_top{display:flex; gap:14px; align-items:flex-start;}
    .property_img{ width:42%;  min-width:160px; height:150px; border-radius:10px; overflow:hidden; background:#ddd; flex-shrink:0;}
      .property_img img{ width:100%; height:100%; object-fit:cover; display:block;}
      .property_info{flex:1;}
      .property_info h3{margin:0 0 6px 0; font-size:17px;}
      .loon{color:#6b7280;}
      .badge{background:#f0fbfa; padding:8px 10px; border-radius:999px; font-size:13px; color:#036b68; display:inline-block;
      margin-top:8px; border:1px solid rgba(3,107,104,0.1);}
      form{background:#ffffff; border-radius:14px; padding:16px;  box-shadow:0 10px 30px rgba(16,24,40,0.08);}
    .field{ display:flex; flex-direction:column; margin-bottom:12px;}
    label{font-size:13px; margin-bottom:6px; color:#6b7280;}
      input[type="text"],
      input[type="tel"],
      input[type="email"]{ width:100%; padding:10px 12px; border-radius:10px; border:1px solid rgba(0,0,0,0.1);
      background:transparent;outline:none;}
    .row{ display:flex; gap:10px;}
      .row .column{ flex:1;}
      .confirm{ display:flex; gap:8px; align-items:center; margin-top:8px;}
      .actions{ margin-top:12px;}

    .btn{background:linear-gradient(90deg,#0ea5a4,#036b68); color:white;  padding:10px 14px;border-radius:12px;
      border:0;  cursor:pointer; font-weight:700;}
     @media(max-width:560px){
      .property_top{flex-direction:column;}
      .property_img{width:100%; height:200px; }
    }

  </style>
</head>

<body>
  <div class="page">

    <header class="header">
      <div class="head-text">
        <div class="title">Apply for This Property</div>
        <div class="subtitle">Fill the form below to submit your application</div>
      </div>
    </header>

    <section class="property">
      <div class="property_top">

        <div class="property_img">
          <img src="" alt="sort el bet">
        </div>

        <div class="property_info">
          <h3>Furnished Apartment in El Nozha</h3>

          <div class="loon">Location: <strong>El Nozha</strong></div>

          <div class="badge">Rent: <strong>12800 EGP / Month</strong></div>
        </div>

      </div>
    </section>

    <form id="applyForm" novalidate>

      <div class="field">
        <label for="fullName">Full Name</label>
        <input id="fullName" type="text" required placeholder="Enter your name">
      </div>

      <div class="row">
        <div class="column">
          <div class="field">
            <label for="phone">Phone Number</label>
            <input id="phone" type="tel" required placeholder="Enter your phone number">
          </div>
        </div>
        <div class="column">
          <div class="field">
            <label for="email">Email</label>
            <input id="email" type="email" required placeholder="you@example.com">
          </div>
        </div>
      </div>

      <div class="field">
        <label for="idNumber">ID (National ID / Passport)</label>
        <input id="idNumber" type="text" required placeholder="e.g. 28701234567890">
      </div>

      <div class="confirm">
        <input id="confirm" type="checkbox" required>
        <label for="confirm" class="muted">I confirm the information is correct.</label>
      </div>

      <div class="actions">
        <button class="btn" type="submit">Submit Application</button>
      </div>

    </form>

  </div>

  <script>
    document.getElementById('applyForm').addEventListener('submit', function(e){
      e.preventDefault();
      
      const name = fullName.value.trim();
      const phone = phone.value.trim();
      const idNum = idNumber.value.trim();

      if(!name || !phone || !idNum){
        alert("Please fill the required fields.");
        return;
      }

      alert("Application submitted. (Demo only)");
      this.reset();
    });
  </script>

</body>
</html>