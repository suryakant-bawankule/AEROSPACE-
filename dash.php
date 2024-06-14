<style>
  /* Dashboard styles */
  .dashboard {
    width: 80%;
    margin: 40px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .dashboard-header {
    background-color: #333;
    color: #fff;
    padding: 10px;
    text-align: center;
  }

  .dashboard-content {
    padding: 20px;
  }

  .user-info {
    margin-bottom: 20px;
  }

  .user-info label {
    font-weight: bold;
    margin-right: 10px;
  }

  .course-info {
    margin-top: 20px;
  }

  .course-info label {
    font-weight: bold;
    margin-right: 10px;
  }

  .course-duration {
    font-size: 18px;
    font-weight: bold;
    color: #666;
  }
</style>

<div class="dashboard">
  <div class="dashboard-header">
    <h2>Dashboard</h2>
  </div>
  <div class="dashboard-content">
    <div class="user-info">
      <label>Username:</label> <?php echo $username; ?><br>
      <label>Email:</label> <?php echo $email; ?><br>
      <label>Phone Number:</label> <?php echo $phone; ?>
    </div>
    <div class="course-info">
      <label>Course:</label> <?php echo $course; ?><br>
      <label>Duration:</label> <span class="course-duration"><?php echo $duration; ?></span>
    </div>
  </div>
</div>