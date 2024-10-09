<?php
function fetchFromApi($url) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $response = curl_exec($ch);
  curl_close($ch);
  return json_decode($response, true);
}

// Fetch country data
$countries = fetchFromApi('https://restcountries.com/v3.1/all');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Database connection
  require('include/db_conn.php');

  // Sanitize and prepare input data
  $name = $conn->real_escape_string($_POST['name']);
  $email = $conn->real_escape_string($_POST['email']);
  $phone = $conn->real_escape_string($_POST['phone']);
  $age = $conn->real_escape_string($_POST['age']);
  $religion = $conn->real_escape_string($_POST['religion']);
  $gender = $conn->real_escape_string($_POST['gender']);
  $dob = $conn->real_escape_string($_POST['dob']);
  $cover_letter = $conn->real_escape_string($_POST['cover_letter']);
  $identity_card = $conn->real_escape_string($_POST['identity_card']);
  $current_status = $conn->real_escape_string($_POST['current_status']);
  $job_type = $conn->real_escape_string($_POST['job_type']);
  $address = $conn->real_escape_string($_POST['address']);
  $country = $conn->real_escape_string($_POST['country']);
  $city = $conn->real_escape_string($_POST['city']);
  $university = $conn->real_escape_string($_POST['university']);
  $degree = $conn->real_escape_string($_POST['degree']);
  $deg_start = $conn->real_escape_string($_POST['deg_start']);
  $deg_end = $conn->real_escape_string($_POST['deg_end']);
  $deg_ongoing = isset($_POST['deg_ongoing']) ? 1 : 0;
  $linkedin = $conn->real_escape_string($_POST['linkedin']);
  $twitter = $conn->real_escape_string($_POST['twitter']);
  $facebook = $conn->real_escape_string($_POST['facebook']);
  $github = $conn->real_escape_string($_POST['github']);
  $pre_work_title = $conn->real_escape_string($_POST['pre_work_title']);
  $company_name = $conn->real_escape_string($_POST['company_name']);
  $pre_work_sdate = $conn->real_escape_string($_POST['pre_work_sdate']);
  $pre_work_edate = $conn->real_escape_string($_POST['pre_work_edate']);
  $apply_position = $conn->real_escape_string($_POST['apply_position']);

  // Handle file upload for CV
  $cv = "";
  if (isset($_FILES['cv']) && $_FILES['cv']['error'] == UPLOAD_ERR_OK) {
    $allowed_ext = 'pdf';
    $file_ext = pathinfo($_FILES['cv']['name'], PATHINFO_EXTENSION);

    if ($file_ext === $allowed_ext) {
      $cv = "api/uploads/" . uniqid() . "." . $file_ext;
      move_uploaded_file($_FILES['cv']['tmp_name'], $cv);
    } else {
      echo "<script>alert('Only PDF files are allowed.')</script>";
      exit;
    }
  }

  // SQL query to insert data
  $sql = "INSERT INTO job_form_details (name, email, phone, age, religion, gender, dob, cv, cover_letter, identity_card, current_status, job_type, address, country, city, university, degree, deg_start, deg_end, deg_ongoing, linkedin, twitter, facebook, github, pre_work_title, company_name, pre_work_sdate, pre_work_edate, apply_position)
            VALUES ('$name', '$email', '$phone', '$age', '$religion', '$gender', '$dob', '$cv', '$cover_letter', '$identity_card', '$current_status', '$job_type', '$address', '$country', '$city', '$university', '$degree', '$deg_start', '$deg_end', '$deg_ongoing', '$linkedin', '$twitter', '$facebook', '$github', '$pre_work_title', '$company_name', '$pre_work_sdate', '$pre_work_edate', '$apply_position')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Record submitted successfully')</script>";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  // Close connection
  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Job Application Form</title>
  <style>
    .form-container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ddd;
      border-radius: 8px;
      background-color: #f9f9f9;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .form-group input[type="text"],
    .form-group input[type="email"],
    .form-group input[type="date"],
    .form-group input[type="file"] {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .form-group input[type="checkbox"] {
      margin-right: 10px;
    }

    button[type="submit"] {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button[type="submit"]:hover {
      background-color: #0056b3;
    }

    .success-message {
      color: green;
      margin-top: 15px;
    }

    .error-message {
      color: red;
      margin-top: 15px;
    }
  </style>
</head>

<body>
  <div class="form-container">
    <form id="job-form" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="name">Name:</label>
        <input
          type="text"
          id="name"
          name="name"
          placeholder="Name"
          required />
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="Email"
          required />
      </div>
      <div class="form-group">
        <label for="phone">Phone:</label>
        <input
          type="text"
          id="phone"
          name="phone"
          placeholder="Phone"
          required />
      </div>
      <div class="form-group">
        <label for="age">Age:</label>
        <input type="text" id="age" name="age" placeholder="Age" required />
      </div>
      <div class="form-group">
        <label for="religion">Religion:</label>
        <input
          type="text"
          id="religion"
          name="religion"
          placeholder="Religion"
          required />
      </div>
      <div class="form-group">
        <label for="gender">Gender:</label>
        <input
          type="text"
          id="gender"
          name="gender"
          placeholder="Gender"
          required />
      </div>
      <div class="form-group">
        <label for="dob">Date of Birth:</label>
        <input
          type="date"
          id="dob"
          name="dob"
          placeholder="Date of Birth"
          required />
      </div>
      <div class="form-group">
        <label for="cover_letter">Cover Letter:</label>
        <input
          type="text"
          id="cover_letter"
          name="cover_letter"
          placeholder="Cover Letter" />
      </div>
      <div class="form-group">
        <label for="identity_card">Identity Card:</label>
        <input
          type="text"
          id="identity_card"
          name="identity_card"
          placeholder="Identity Card" />
      </div>
      <div class="form-group">
        <label for="current_status">Current Status:</label>
        <input
          type="text"
          id="current_status"
          name="current_status"
          placeholder="Current Status" />
      </div>
      <div class="form-group">
        <label for="job_type">Job Type:</label>
        <input
          type="text"
          id="job_type"
          name="job_type"
          placeholder="Job Type" />
      </div>
      <div class="form-group">
        <label for="address">Address:</label>
        <input
          type="text"
          id="address"
          name="address"
          placeholder="Address" />
      </div>
      <div class="form-group">
        <label for="country">Country:</label>
        <select name="country" id="country" required>
          <option value="">Select Country</option>
          <?php foreach ($countries as $country): ?>
            <option value="<?php echo $country['name']['common']; ?>"><?php echo $country['name']['common']; ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label for="city">City:</label>
        <select name="city" id="city" required>
          <option value="">Select City</option>
          <!-- Cities will be dynamically populated -->
        </select>
      </div>
      <div class="form-group">
        <label for="university">University:</label>
        <select name="university" id="university" required>
          <option value="">Select University</option>
          <!-- Universities will be dynamically populated -->
        </select>
      </div>
      <div class="form-group">
        <label for="degree">Degree:</label>
        <input type="text" id="degree" name="degree" placeholder="Degree" />
      </div>
      <div class="form-group">
        <label for="deg_start">Degree Start Date:</label>
        <input
          type="date"
          id="deg_start"
          name="deg_start"
          placeholder="Degree Start Date" />
      </div>
      <div class="form-group">
        <label for="deg_end">Degree End Date:</label>
        <input
          type="date"
          id="deg_end"
          name="deg_end"
          placeholder="Degree End Date" />
      </div>
      <div class="form-group">
        <label>
          <input type="checkbox" id="deg_ongoing" name="deg_ongoing" />
          Ongoing Degree
        </label>
      </div>
      <div class="form-group">
        <label for="linkedin">LinkedIn:</label>
        <input
          type="text"
          id="linkedin"
          name="linkedin"
          placeholder="LinkedIn" />
      </div>
      <div class="form-group">
        <label for="twitter">Twitter:</label>
        <input
          type="text"
          id="twitter"
          name="twitter"
          placeholder="Twitter" />
      </div>
      <div class="form-group">
        <label for="facebook">Facebook:</label>
        <input
          type="text"
          id="facebook"
          name="facebook"
          placeholder="Facebook" />
      </div>
      <div class="form-group">
        <label for="github">GitHub:</label>
        <input type="text" id="github" name="github" placeholder="GitHub" />
      </div>
      <div class="form-group">
        <label for="pre_work_title">Previous Work Title:</label>
        <input
          type="text"
          id="pre_work_title"
          name="pre_work_title"
          placeholder="Previous Work Title" />
      </div>
      <div class="form-group">
        <label for="company_name">Company Name:</label>
        <input
          type="text"
          id="company_name"
          name="company_name"
          placeholder="Company Name" />
      </div>
      <div class="form-group">
        <label for="pre_work_sdate">Previous Work Start Date:</label>
        <input
          type="date"
          id="pre_work_sdate"
          name="pre_work_sdate"
          placeholder="Previous Work Start Date" />
      </div>
      <div class="form-group">
        <label for="pre_work_edate">Previous Work End Date:</label>
        <input
          type="date"
          id="pre_work_edate"
          name="pre_work_edate"
          placeholder="Previous Work End Date" />
      </div>
      <div class="form-group">
        <label for="apply_position">Position Applying For:</label>
        <input
          type="text"
          id="apply_position"
          name="apply_position"
          placeholder="Position Applying For" />
      </div>
      <div class="form-group">
        <label for="cv">CV:</label>
        <input type="file" id="cv" name="cv" />
      </div>
      <button type="submit">Submit</button>
      <div id="messages">
        <!-- Success and error messages will be displayed here -->
      </div>
    </form>
  </div>
  <script>
    document.getElementById('country').addEventListener('change', function () {
      const country = this.value;
      if (country) {
        fetchCitiesAndUniversities(country);
      } else {
        populateSelect('city', []);
        populateSelect('university', []);
      }
    });

    function fetchCitiesAndUniversities(country) {
      // Fetch cities
      fetch(`https://countriesnow.space/api/v0.1/countries/cities/q?country=${encodeURIComponent(country)}`)
        .then(response => response.json())
        .then(data => {
          const cities = data.data || [];
          populateSelect('city', cities);
        })
        .catch(error => {
          console.error('Error fetching cities:', error);
          populateSelect('city', []);
        });

      // Fetch universities
      fetch(`http://universities.hipolabs.com/search?country=${encodeURIComponent(country)}`)
        .then(response => response.json())
        .then(data => {
          const universities = data || [];
          populateSelect('university', universities.map(uni => uni.name));
        })
        .catch(error => {
          console.error('Error fetching universities:', error);
          populateSelect('university', []);
        });
    }

    function populateSelect(id, items) {
      const select = document.getElementById(id);
      select.innerHTML = '<option value="">Select</option>';
      items.forEach(item => {
        const option = document.createElement('option');
        option.value = item;
        option.textContent = item;
        select.appendChild(option);
      });
    }
  </script>
</body>

</html>