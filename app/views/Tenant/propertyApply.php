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
    
    .back-btn {
        display: inline-block;
        padding: 10px 20px;
        background: #418beb;
        color: white;
        text-decoration: none;
        border-radius: 8px;
        margin-bottom: 20px;
    }
    
    .header{ display:flex; gap:12px; align-items:center; margin-bottom:18px;}
    .head-text .title{font-size:24px; font-weight:700;}
    .head-text .subtitle{ font-size:14px; color:#555;}
    
    .property{ background:#ffffff; border-radius:14px; padding:18px; 
               box-shadow:0 10px 30px rgba(16,24,40,0.08); margin-bottom:20px;}
    .property_top{display:flex; gap:14px; align-items:flex-start;}
    .property_img{ width:42%; min-width:160px; height:150px; border-radius:10px; 
                   overflow:hidden; background:#ddd; flex-shrink:0;}
    .property_img img{ width:100%; height:100%; object-fit:cover; display:block;}
    .property_info{flex:1;}
    .property_info h3{margin:0 0 6px 0; font-size:17px;}
    .location{color:#6b7280; margin:5px 0;}
    .badge{background:#f0fbfa; padding:8px 12px; border-radius:999px; font-size:14px; 
           color:#036b68; display:inline-block; margin-top:8px; 
           border:1px solid rgba(3,107,104,0.1);}
    
    form{background:#ffffff; border-radius:14px; padding:20px; 
         box-shadow:0 10px 30px rgba(16,24,40,0.08);}
    .field{ display:flex; flex-direction:column; margin-bottom:15px;}
    label{font-size:14px; margin-bottom:6px; color:#333; font-weight:500;}
    
    input[type="text"],
    input[type="tel"],
    input[type="email"],
    textarea{ 
        width:100%; 
        padding:12px; 
        border-radius:10px; 
        border:1px solid rgba(0,0,0,0.2);
        background:white;
        outline:none;
        font-size:14px;
    }
    
    textarea {
        min-height: 100px;
        resize: vertical;
        font-family: inherit;
    }
    
    input:focus, textarea:focus {
        border-color: #036b68;
    }
    
    .row{ display:flex; gap:10px;}
    .row .column{ flex:1;}
    .confirm{ display:flex; gap:8px; align-items:center; margin-top:8px;}
    .actions{ margin-top:15px;}

    .btn{
        background:linear-gradient(90deg,#0ea5a4,#036b68); 
        color:white; 
        padding:12px 16px;
        border-radius:12px;
        border:0; 
        cursor:pointer; 
        font-weight:700;
        width: 100%;
        font-size: 16px;
    }
    
    .btn:hover {
        background:linear-gradient(90deg,#0d9493,#025a57);
    }
    
    .success-message {
        background: #d4edda;
        color: #155724;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    
    .error-message {
        background: #f8d7da;
        color: #721c24;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
    }
    
    @media(max-width:560px){
      .property_top{flex-direction:column;}
      .property_img{width:100%; height:200px;}
      .row{flex-direction: column;}
    }
  </style>
</head>

<body>
  <div class="page">
    <a href="?url=TenantController/propertyDetails&id=<?= $property['property_id'] ?>" class="back-btn">← Back</a>

    <header class="header">
      <div class="head-text">
        <div class="title">Apply for This Property</div>
        <div class="subtitle">Fill out the form below to submit your rental application</div>
      </div>
    </header>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="success-message">
            <?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message">
            <?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <section class="property">
      <div class="property_top">
        <div class="property_img">
          <img src="<?= htmlspecialchars($property['main_image'] ?? 'https://via.placeholder.com/300x200?text=No+Image') ?>" 
               alt="<?= htmlspecialchars($property['title']) ?>"
               onerror="this.src='https://via.placeholder.com/300x200?text=No+Image'">
        </div>

        <div class="property_info">
          <h3><?= htmlspecialchars($property['title']) ?></h3>
          <div class="location">📍 Location: <strong><?= htmlspecialchars($property['city']) ?></strong></div>
          <div class="badge">Rent: <strong><?= number_format($property['monthly_rent'], 0) ?> EGP / Month</strong></div>
        </div>
      </div>
    </section>

    <form method="POST" action="?url=TenantController/propertyApply&id=<?= $property['property_id'] ?>">
      <div class="field">
        <label for="fullName">Full Name *</label>
        <input id="fullName" name="fullName" type="text" required 
               placeholder="Enter your full name"
               value="<?= htmlspecialchars($user['name']) ?>">
      </div>

      <div class="row">
        <div class="column">
          <div class="field">
            <label for="phone">Phone Number *</label>
            <input id="phone" name="phone" type="tel" required 
                   placeholder="Enter your phone"
                   value="<?= htmlspecialchars($user['phone']) ?>">
          </div>
        </div>
        <div class="column">
          <div class="field">
            <label for="email">Email *</label>
            <input id="email" name="email" type="email" required 
                   placeholder="you@example.com"
                   value="<?= htmlspecialchars($user['email']) ?>">
          </div>
        </div>
      </div>

      <div class="field">
        <label for="message">Message (Optional)</label>
        <textarea id="message" name="message" 
                  placeholder="Tell the landlord why you're interested in this property..."></textarea>
      </div>

      <div class="confirm">
        <input id="confirm" name="confirm" type="checkbox" required>
        <label for="confirm">I confirm that all information provided is accurate.</label>
      </div>

      <div class="actions">
        <button class="btn" type="submit">Submit Application</button>
      </div>
    </form>
  </div>
</body>
</html>